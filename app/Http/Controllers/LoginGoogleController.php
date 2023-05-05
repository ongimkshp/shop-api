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

    /**
     * @OA\Get(
     *      path="/api/auth/google",
     *      operationId="redirectToGoogle",
     *      tags={"Auth"},
     *      summary="Redirect to Google",
     *      description="Redirect to Google",
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *            type="object",
     *            @OA\Property(property="redirectUrl", type="string", example="https://accounts.google.com/o/oauth2/auth?response_type=code&client_id=123456789&redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Fapi%2Fauth%2Fgoogle%2Fcallback&scope=&state=123456789")
     *          )
     *      )
     * )
     */
    public function redirectToGoogle()
    {
        $redirectUrl = Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
        return ApiResponse::createSuccessResponse(['redirectUrl' => $redirectUrl]);
    }

    /**
     * @OA\Get(
     *      path="/api/auth/google/callback",
     *      operationId="handleGoogleCallback",
     *      tags={"Auth"},
     *      summary="Handle Google Callback",
     *      description="Handle Google Callback",
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *            type="object",
     *            @OA\Property(property="access_token", type="string", example="123456789"),
     *            @OA\Property(property="token_type", type="string", example="bearer"),
     *            @OA\Property(property="expires_in", type="integer", example=3600),
     *            @OA\Property(property="refresh_token", type="string", example="123456789"),
     *          )
     *      )
     * )
     */
    public function handleGoogleCallback()
    {
        return ApiResponse::createSuccessResponse($this->googleService->handleGoogleCallback());
    }
}
