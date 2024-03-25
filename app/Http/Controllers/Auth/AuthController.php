<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Auth\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        try {
            $tokenData = $this->authService->login($request->only(['email', 'password']));
            return response()->json($tokenData, 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
