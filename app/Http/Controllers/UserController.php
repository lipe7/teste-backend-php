<?php

namespace App\Http\Controllers;

use App\Domain\User\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserDataRequest;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(CreateUserRequest $request)
    {
        $user = $this->userService->createUser($request);
        return response()->json($user, 201);
    }

    public function update(UpdateUserDataRequest $request)
    {
        try {
            $user = $this->userService->updateUser($request);
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function delete()
    {
        try {
            $this->userService->delete();
            return response()->json(['message' => 'User deleted successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function getUserById($id)
    {
        try {
            $user = $this->userService->getUserById($id);
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }
}
