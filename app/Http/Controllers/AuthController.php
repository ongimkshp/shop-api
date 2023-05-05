<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LoginWithEmailRequest;
use App\Http\Requests\RefreshTokenRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\VerifyEmailOtpRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\AuthService;

class AuthController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->authService->createUser($request);
        return ApiResponse::createSuccessResponse(new UserResource($user));
    }

    public function loginByEmailPassword(LoginRequest $request)
    {
        $response = $this->authService->loginByEmailPassword($request);
        return ApiResponse::createSuccessResponse($response);
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request);
        return ApiResponse::createSuccessResponse('Logout successfully');
    }

    public function refresh(RefreshTokenRequest $request)
    {
        $response = $this->authService->refreshToken($request);
        return ApiResponse::createSuccessResponse($response);
    }

    public function loginWithEmail(LoginWithEmailRequest $request)
    {
        $this->authService->sendOtpToEmail($request);
        return ApiResponse::createSuccessResponse('OTP sent to your email');
    }

    public function verifyEmailOtp(VerifyEmailOtpRequest $request)
    {
        $response = $this->authService->verifyEmailOtp($request);
        return ApiResponse::createSuccessResponse($response);
    }
}
