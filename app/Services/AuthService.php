<?php

namespace App\Services;

use App\Repositories\Contracts\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Exceptions\ResourceNotFoundException;

class AuthService
{
    public function __construct(
        private AuthRepositoryInterface $authRepo
    ) {}

    // تسجيل مستخدم جديد
    public function register(array $data)
    {
        try {
            $data['password'] = Hash::make($data['password']);

            $user = $this->authRepo->createUser($data);

            if (!$user) {
                throw new \Exception('Failed to create user');
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return [
                'user' => $user,
                'token' => $token,
            ];
        } catch (\Exception $e) {
            throw new \Exception('Registration error: ' . $e->getMessage());
        }
    }

    // تسجيل الدخول
    public function login(array $data)
    {
        $user = $this->authRepo->findUserByEmail($data['email']);

        if (!$user) {
            throw new ResourceNotFoundException('User with this email');
        }

        if (!Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    // تسجيل الخروج
    public function logout($user)
    {
        if (!$user) {
            throw new ResourceNotFoundException('User');
        }

        $deleted = $user->tokens()->delete();

        if ($deleted === 0) {
            throw new \Exception('Failed to logout user');
        }

        return ['message' => 'Logged out successfully'];
    }
}
