<?php

namespace App\Http\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Services\TokenService;

class GoogleService
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $user = $this->userRepo->createGoogleUser($user);
        return TokenService::generateTokenById($user->id);
    }
}
