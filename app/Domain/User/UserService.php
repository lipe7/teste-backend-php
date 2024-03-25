<?php

namespace App\Domain\User;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserDataRequest;
use GuzzleHttp\Exception\ConnectException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(CreateUserRequest $request)
    {
        try {
            $userData = $request->all();
            $user = $this->userRepository->create($userData);

            $tokenTTL = config('jwt.ttl');
            $token = JWTAuth::fromUser($user, ['ttl' => $tokenTTL]);

            return [
                'user' => $user,
                'token' => $token,
                'expires' => $tokenTTL
            ];
        } catch (BadRequestHttpException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        } catch (ConnectException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateUser(UpdateUserDataRequest $request)
    {
        $userData = $request->all();
        $authenticatedUserId = auth()->id();
        if (!$authenticatedUserId) {
            throw new \Exception('You do not have permission to update this user.');
        }

        $user = $this->userRepository->findById($authenticatedUserId);
        if (!$user) {
            throw new \Exception('User not found.');
        }

        $user->update($userData);

        return $user;
    }

    public function delete()
    {
        $authenticatedUserId = auth()->id();
        if (!$authenticatedUserId) {
            throw new \Exception('You do not have permission to delete this user.');
        }

        $user = $this->userRepository->findById($authenticatedUserId);
        if (!$user) {
            throw new \Exception('User not found.', 404);
        }

        $user->delete();
    }

    public function getUserById($id)
    {
        $user = $this->userRepository->findById($id);
        if (!$user) {
            throw new \Exception('User not found.', 404);
        }

        return $user;
    }
}
