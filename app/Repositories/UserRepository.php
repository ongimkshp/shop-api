<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getUserByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function createUser($user)
    {
        return $this->model->create($user);
    }

    public function createGoogleUser($user)
    {
        $user = User::firstOrCreate(
            ['email' => $user->email],
            [
                'name' => $user->name,
                'email' => $user->email,
                'password' => bcrypt($user->id),
                'google_id' => $user->id,
            ]
        );
        return $user;
    }
}
