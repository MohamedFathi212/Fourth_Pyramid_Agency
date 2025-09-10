<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    public function user_can_register()
    {
        $response = $this->postJson('/v1/api/register', [
            'name'                  => 'John Doe',
            'email'                 => 'john@example.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['user', 'token']);
    }

    public function user_can_login()
    {
        $user = User::factory()->create(['password' => bcrypt('password123')]);

        $response = $this->postJson('/v1/api/login', [
            'email'    => $user->email,
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['user', 'token']);
    }

    public function user_can_logout()
    {
        $user = User::factory()->create();

        $token = $user->createToken('api-token')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/v1/api/logout');

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Successfully logged out']);
    }
}
