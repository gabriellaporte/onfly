<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Checa se o registro está funcionando e criando um usuário
     */
    public function test_register_function_ok(): void
    {
        $response = $this->postJson('/api/auth/register', [
            'email' => 'teste@gmail.com',
            'name' => 'teste',
            'password' => 'password'
        ]);

        $response->assertJsonStructure([
           'message',
           'data' => [
               'userID',
               'token',
               'userInfo' => [
                   'id',
                   'name',
                   'email',
                   '_links' => [
                       'self' => [
                           'href'
                       ],
                       'expenses' => [
                           'href'
                       ]
                   ]
               ]
           ]
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'teste@gmail.com',
            'name' => 'teste'
        ]);
    }

    /**
     * Checa se o login está funcionando e retornando um token
     */
    public function test_login_function_ok(): void
    {
        User::factory()->create([
            'email' => 'teste@gmail.com',
            'name' => 'teste',
            'password' => bcrypt('password')
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => 'teste@gmail.com',
            'password' => 'password'
        ]);

        $response->assertOk()
            ->assertJsonStructure([
                'message',
                'data' => [
                    'userID',
                    'token'
                ]
            ]);
    }
}
