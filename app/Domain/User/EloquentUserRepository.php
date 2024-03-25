<?php

namespace App\Domain\User;

use App\Models\User;

class EloquentUserRepository implements UserRepository
{
    public function findByLoginAndPassword($login, $password)
    {
        return User::where('login', $login)->where('password', $password)->first();
    }

    public function create(array $userData)
    {
        return User::create($userData);
    }

    public function findById(int $userId)
    {
        return User::find($userId);
    }
}
