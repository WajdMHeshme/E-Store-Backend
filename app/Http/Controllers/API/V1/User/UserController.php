<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Http\Requests\API\V1\User\UpdateUserRequest;
use App\Http\Requests\API\V1\User\StoreUserRequest;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function __construct(private UserService $userService) {}

    public function index()
    {
        return UserResource::collection(
            $this->userService->getAllUsers()
        );
    }

    public function show($id)
    {
        return new UserResource(
            $this->userService->getUserById($id)
        );
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->createUser($request->validated());

        return response()->json([
            'message' => 'User created successfully',
            'data' => new UserResource($user)
        ], 201);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->userService->updateUser($id, $request->validated());

        return response()->json([
            'message' => 'User updated successfully',
            'data' => new UserResource($user)
        ]);
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);

        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }
}
