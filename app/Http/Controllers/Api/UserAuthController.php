<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserLoginRequest;
use App\Http\Requests\Api\UserRegisterRequest;
use App\Http\Resources\Api\UserResource;
use App\Services\Api\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserAuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(UserRegisterRequest $request)
    {
        $registerUserData = $request->validated();

        $result = $this->authService->register($registerUserData);

        return response()->json([
            'message' => 'User created successfully',
            'user' => new UserResource($result['user']),
            'access_token' => $result['access_token'],
        ], Response::HTTP_CREATED);
    }

    public function login(UserLoginRequest $request)
    {
        $loginUserData = $request->validated();

        $result = $this->authService->login($loginUserData);

        if (isset($result['error'])) {
            return response()->json([
                'message' => $result['error'],
            ], $result['status']);
        }

        return response()->json([
            'user' => new UserResource($result['user']),
            'access_token' => $result['access_token'],
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        $result = $this->authService->logout($request->user());

        return response()->json([
            'message' => $result['message'],
        ]);
    }
}
