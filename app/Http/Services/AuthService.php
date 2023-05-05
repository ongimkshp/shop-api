<?php

namespace App\Http\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Laravel\Passport\RefreshTokenRepository;
use App\Http\Services\TokenService;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginMail;
use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function createUser($request)
    {
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ];
        return $this->userRepo->createUser($data);
    }

    public function loginByEmailPassword($request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $response = TokenService::generateTokenByPassword($email, $password);
        return $response;
    }

    public function logout($request)
    {
        $refreshTokenRepository = app(RefreshTokenRepository::class);
        $accessToken = $request->user()->token();

        $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($accessToken->id);
        $accessToken->delete();
        auth()->guard('web')->logout();
    }

    public function refreshToken($request)
    {
        $refreshToken = $request->input('refresh_token');
        $response = TokenService::generateRefreshToken($refreshToken);
        return $response;
    }

    public function sendOtpToEmail($request)
    {
        $email = $request->email;
        $user = $this->userRepo->getUserByEmail($email);
        if (!$user) {
            return ApiResponse::createFailedResponse('Email not found', 404);
        }
        Mail::to($request->email)->send(new LoginMail($user->id));
    }

    public function verifyEmailOtp($request)
    {
        Auth::loginUsingId($request->userId);
        $response = TokenService::generateTokenById($request->userId);
        return $response;
    }
}
