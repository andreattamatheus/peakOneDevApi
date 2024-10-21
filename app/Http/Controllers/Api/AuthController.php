<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserCreateResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(
        private UserService $userService
    ) {}

    /**
     * Get a JWT via given credentials.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (! auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => false,
                'message' => 'Password is incorrect',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = $this->userService->getUserToken($request->email);

        return response()->json([
            'message' => 'User logged in successfully',
            'access_token' => $token,
        ], Response::HTTP_OK);
    }

    /**
     * Create user
     */
    public function register(RegisterRequest $request): UserCreateResource
    {
        try {
            $user = $this->userService->createUser($request->validated());

            return new UserCreateResource($user);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
