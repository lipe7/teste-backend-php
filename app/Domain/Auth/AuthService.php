<?php

namespace App\Domain\Auth;

use App\Domain\User\UserRepository;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(array $credentials)
    {
        if (!$token = JWTAuth::attempt($credentials)) {
            throw new \Exception('Usuário não pode ser autenticado!');
        }

        $user = auth()->user();

        return [
            'status' => 'success',
            'message' => 'Usuário criado e JWT encontrado',
            'tokenjwt' => $token,
            'expires' => now()->addMinutes(config('auth.token_expires'))->toDateTimeString(),
            'tokenmsg' => 'Use o token para acessar os endpoints!',
            'user' => $user
        ];
    }
}
