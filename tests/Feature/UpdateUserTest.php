<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class UpdateUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testUpdateUser()
    {
        $user = User::factory()->create();

        $token = JWTAuth::fromUser($user);

        $updateData = [
            'name' => 'Name Update',
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->putJson('/api/user', $updateData);

        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $updateData['name'],
        ]);
    }
}
