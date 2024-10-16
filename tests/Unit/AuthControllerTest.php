<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa o registro de usuário.
     */
    public function test_user_can_register()
    {
        $response = $this->post('api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    /**
     * Testa o login do usuário.
     */
    public function test_user_can_login()
    {
        // Cria um usuário fictício
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('api/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['user', 'token']);
    }

    /**
     * Testa o logout do usuário autenticado.
     */
    public function test_user_can_logout()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->post('api/logout');

        $response->assertStatus(200)
                 ->assertJson(['mensagem' => 'Você saiu da sua conta.']);
    }
}
