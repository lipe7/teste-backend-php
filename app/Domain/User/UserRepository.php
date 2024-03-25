<?php

namespace App\Domain\User;

interface UserRepository
{
    public function create(array $userData);
    public function findById(int $userId);
}
