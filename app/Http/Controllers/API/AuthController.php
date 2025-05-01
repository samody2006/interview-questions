<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Registration Resources
     * @param AuthRequest $request
     * @return JsonResponse
     */
    public function register(AuthRequest $request): JsonResponse
    {
        $data = $this->authService->register($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            'data' => $data
        ], 201);
    }

    /**
     * Login Resources
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $this->authService->login($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => $data
        ]);
    }

    /**
     * Logout Resources
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request);

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully',
        ]);
    }

    /**
     * Get Authenticated User Resources
     * @param Request $request
     * @return JsonResponse
     */
    public function user(Request $request): JsonResponse
    {
        $user = $this->authService->getAuthenticatedUser($request);

        return response()->json([
            'success' => true,
            'message' => 'User returned successfully',
            'data' => $user,
        ]);
    }
}
