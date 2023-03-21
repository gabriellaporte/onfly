<?php

namespace Tests\Feature\Endpoints;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthEndpointTest extends TestCase
{
    /**
     * Teste de endpoint de registro, deve retornar 405
     *
     * @return void
     */
    public function test_register_endpoint(): void
    {
        $response = $this->postJson('/api/auth/register');

        $response->assertStatus(422)
            ->assertJsonFragment([
            'message' => 'Erro de validação'
        ]);
    }

    /**
     * Teste de endpoint de login, deve retornar 405
     *
     * @return void
     */
    public function test_login_endpont(): void
    {
        $response = $this->postJson('/api/auth/login');

        $response->assertStatus(422)
            ->assertJsonFragment([
            'message' => 'Erro de validação'
        ]);
    }
}
