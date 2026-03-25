<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Exceptions\CartEmptyException;
use App\Exceptions\ProductOutOfStockException;
use App\Exceptions\ResourceNotFoundException;
use App\Exceptions\UnauthorizedActionException;

class Handler extends ExceptionHandler
{
    /**
     * Render an exception into an HTTP response.
     *
     * @param mixed $request
     * @param \Throwable $e
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $e)
    {
        if ($request->is('api/*')) {

            // Throttle Exception
            if ($e instanceof ThrottleRequestsException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Too many requests. Please try again later.',
                    'retry_after' => $e->getHeaders()['Retry-After'] ?? null
                ], 429);
            }

            // CartEmptyException
            if ($e instanceof CartEmptyException) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ], 422);
            }

            // ProductOutOfStockException
            if ($e instanceof ProductOutOfStockException) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ], 422);
            }

            // ResourceNotFoundException
            if ($e instanceof ResourceNotFoundException) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ], 404);
            }

            // UnauthorizedActionException
            if ($e instanceof UnauthorizedActionException) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ], 403);
            }

            // Validation Exception
            if ($e instanceof ValidationException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $e->errors(),
                ], 422);
            }

            // Not Found HTTP Exception (Route not found)
            if ($e instanceof NotFoundHttpException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Route not found',
                ], 404);
            }
        }

        return parent::render($request, $e);
    }
}
