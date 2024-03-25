<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testCreateUser()
    {
        $userData = [
            'name' => 'New User',
            'email' => 'new.user@example.com',
            'cpf' => '123.456.789-00',
            'password' => '123456',
        ];

        $response = $this->postJson('/api/user', $userData);

        $response->assertStatus(Response::HTTP_CREATED);

        $response->assertJsonStructure([
            'user',
            'token',
            'expires',
        ]);
    }
}
