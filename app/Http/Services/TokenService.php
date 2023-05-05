<?php

namespace App\Http\Services;

use App\Helpers\ApiResponse;

class TokenService
{

    public static function generateTokenByPassword($email, $password)
    {
        $params = [
            'grant_type' => 'password',
            'client_id' => config('services.passport.passport_client_id'),
            'client_secret' => config('services.passport.passport_client_secret'),
            'username' => $email,
            'password' => $password,
            'scope' => '*',
        ];
        return self::getAuthToken($params);
    }

    public static function generateTokenById($id)
    {
        $params = [
            'grant_type' => 'custom_grant',
            'id' => $id,
            'client_id' => config('services.passport.passport_client_id'),
            'client_secret' => config('services.passport.passport_client_secret'),
            'scope' => '*',
        ];
        return self::getAuthToken($params);
    }

    public static function generateRefreshToken($refreshToken)
    {
        $params = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
            'client_id' => config('services.passport.passport_client_id'),
            'client_secret' => config('services.passport.passport_client_secret'),
            'scope' => '*',
        ];
        return self::getAuthToken($params);
    }

    public static function getAuthToken($params)
    {
        try {
            $proxy = \Request::create('oauth/token', 'post', $params);
            $response = json_decode(app()->handle($proxy)->getContent());
            return $response;
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode() === 400) {
                return ApiResponse::createFailedResponse('Invalid Request. Please enter a username or a password.', $e->getCode());
            } else if ($e->getCode() === 401) {
                return ApiResponse::createFailedResponse('Your credentials are incorrect. Please try again', $e->getCode());
            }
            return ApiResponse::createFailedResponse('Something went wrong on the server.', $e->getCode());
        }
    }
}
