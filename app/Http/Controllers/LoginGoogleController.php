<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Services\GoogleService;

class LoginGoogleController extends Controller
{
    protected $googleService;

    public function __construct(GoogleService $googleService)
    {
        $this->googleService = $googleService;
    }

    public function redirectToGoogle()
    {
        $redirectUrl = Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
        return ApiResponse::createSuccessResponse(['redirectUrl' => $redirectUrl]);
    }

    public function handleGoogleCallback()
    {
        return ApiResponse::createSuccessResponse($this->googleService->handleGoogleCallback());
    }
}
