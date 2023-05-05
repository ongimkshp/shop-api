<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function getUserByEmail($email);
    public function createUser(array $user);
    public function createGoogleUser(array $user);
}
