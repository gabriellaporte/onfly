<?php

namespace Tests\Feature\Endpoints;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthEndpointTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa o registro de usuário, caso o registro seja bem sucedido, deve retornar 201
     *
     * @return void
     */
    public function test_register_endpoint_ok(): void
    {
        $response = $this->postJson('/api/auth/register', [
            'email' => 'teste@gmail.com',
            'name' => 'teste',
            'password' => 'password'
        ]);

        $response->assertCreated();
    }

    /**
     * Testa o registro de usuário, caso o registro seja mal sucedido, deve retornar 422
     *
     * @return void
     */
    public function test_register_endpoint_unprocessable_entity(): void
    {
        $response = $this->postJson('/api/auth/register', [
            'email' => 'email_invalido'
        ]);

        $response->assertStatus(422);
    }

    /**
     * Testa o login de usuário, caso o login seja bem sucedido, deve retornar 200
     */
    public function test_login_endpoint_ok(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertOk();
    }

    /**
     * Testa o login de usuário, caso o login seja mal sucedido, deve retornar 401
     */
    public function test_login_endpoint_unauthorized(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'algumoutroemail@gmail.com',
            'password' => 'password'
        ]);

        $response->assertUnauthorized();
    }

    /**
     * Testa o login de usuário, caso o login tenha erro de validação, deve retornar 422
     */
    public function test_login_endpoint_unprocessable_entity(): void
    {
        $response = $this->postJson('/api/auth/login');

        $response->assertStatus(422);
    }
}
