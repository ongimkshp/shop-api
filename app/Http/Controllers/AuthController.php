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
use App\Http\Services\AuthService;

class AuthController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @OA\Post(
     *      path="/api/auth/register",
     *      operationId="register",
     *      tags={"Auth"},
     *      summary="Register",
     *      description="Register",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/UserResource")
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation Error",
     *          @OA\JsonContent(
     *            type="object",
     *            @OA\Property(property="message", type="string", example="The given data was invalid."),
     *            @OA\Property(property="errors", type="array", @OA\Items(type="string"), example={"The name field is required.", "The email field is required."}),
     *          )
     *      )
     * )
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->authService->createUser($request);
        return ApiResponse::createSuccessResponse(new UserResource($user));
    }

    /**
     * @OA\Post(
     *      path="/api/auth/login",
     *      operationId="login",
     *      tags={"Auth"},
     *      summary="Login",
     *      description="Login by email passpord",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *            type="object",
     *            @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9"),
     *            @OA\Property(property="expires_in", type="integer", example=3600),
     *            @OA\Property(property="refresh_token", type="string", example="def50200b3d0f7f3a3b3a"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation Error",
     *          @OA\JsonContent(
     *            type="object",
     *            @OA\Property(property="message", type="string", example="The given data was invalid."),
     *            @OA\Property(property="errors", type="array", @OA\Items(type="string"), example={"The password field is required.", "The email field is required."}),
     *          )
     *      )
     * )
     */
    public function loginByEmailPassword(LoginRequest $request)
    {
        $response = $this->authService->loginByEmailPassword($request);
        return ApiResponse::createSuccessResponse($response);
    }

    /**
     * @OA\Post(
     *      path="/api/auth/logout",
     *      operationId="logout",
     *      tags={"Auth"},
     *      summary="logout",
     *      description="logout",
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *            type="object",
     *            @OA\Property(property="message", type="string", example="Logout successfully"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="message", type="string", example="Unauthorized"),
     *              @OA\Property(property="errors", type="array", @OA\Items(type="string"), example={"Invalid credentials"}),
     *          )
     *      )
     * )
     */
    public function logout(Request $request)
    {
        $this->authService->logout($request);
        return ApiResponse::createSuccessResponse('Logout successfully');
    }

    /**
     * @OA\Post(
     *      path="/api/auth/refresh",
     *      operationId="refresh",
     *      tags={"Auth"},
     *      summary="refresh",
     *      description="Refresh token",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/RefreshTokenRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *            type="object",
     *            @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9"),
     *            @OA\Property(property="expires_in", type="integer", example=3600),
     *            @OA\Property(property="refresh_token", type="string", example="def50200b3d0f7f3a3b3a"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation Error",
     *          @OA\JsonContent(
     *            type="object",
     *            @OA\Property(property="message", type="string", example="The given data was invalid."),
     *            @OA\Property(property="errors", type="array", @OA\Items(type="string"), example={"The refresh token field is required."}),
     *          )
     *       )
     * )
     */
    public function refresh(RefreshTokenRequest $request)
    {
        $response = $this->authService->refreshToken($request);
        return ApiResponse::createSuccessResponse($response);
    }

    /**
     * @OA\Post(
     *      path="/api/login/email-otp",
     *      operationId="login-email-otp",
     *      tags={"Auth"},
     *      summary="Login email-otp",
     *      description="Login by email-otp",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/LoginWithEmailRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *            type="object",
     *            @OA\Property(property="message", type="string", example="OTP sent to your email"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation Error",
     *          @OA\JsonContent(
     *            type="object",
     *            @OA\Property(property="message", type="string", example="The given data was invalid."),
     *            @OA\Property(property="errors", type="array", @OA\Items(type="string"), example={"The email field is required."}),
     *          )
     *       ),
     * )
     */
    public function loginWithEmail(LoginWithEmailRequest $request)
    {
        $this->authService->sendOtpToEmail($request);
        return ApiResponse::createSuccessResponse('OTP sent to your email');
    }

    /**
     * @OA\Get(
     *      path="/api/verify/email-otp",
     *      operationId="verify-email-otp",
     *      tags={"Auth"},
     *      summary="Verify email-otp",
     *      description="Verify email-otp",
     *      @OA\Parameter(
     *        name="userId",
     *        in="query",
     *        required=true,
     *        description="User Id",
     *        @OA\Schema(
     *          type="integer",
     *          example=1
     *        )
     *      ),
     *      @OA\Parameter(
     *        name="signature",
     *        in="query",
     *        required=true,
     *        description="Signature",
     *        @OA\Schema(
     *          type="string",
     *          example="def50200b3d0f7f3a3b3a"
     *        )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *            type="object",
     *            @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9"),
     *            @OA\Property(property="expires_in", type="integer", example=3600),
     *            @OA\Property(property="refresh_token", type="string", example="def50200b3d0f7f3a3b3a"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation Error",
     *          @OA\JsonContent(
     *            type="object",
     *            @OA\Property(property="message", type="string", example="The given data was invalid."),
     *            @OA\Property(property="errors", type="array", @OA\Items(type="string"), example={"The email field is required."}),
     *          )
     *       ),
     * )
     */
    public function verifyEmailOtp(VerifyEmailOtpRequest $request)
    {
        $response = $this->authService->verifyEmailOtp($request);
        return ApiResponse::createSuccessResponse($response);
    }
}
