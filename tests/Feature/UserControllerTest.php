<?php

namespace Tests\Feature;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * Checa se a função de obter um usuário está funcionando
     *
     * @return void
     */
    public function test_get_user_function_ok(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->getJson('/api/users/' . $user->id);

        $response->assertJsonStructure([
            'message',
            'data' => [
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
        ]);
    }

    /**
     * Checa se a função de obter um usuário está retornando o erro correto
     *
     * @return void
     */
    public function test_get_user_function_error(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->getJson('/api/users/0');

        $response->assertNotFound()
            ->assertExactJson([
            'message' => 'Recurso não encontrado.'
        ]);
    }

    /**
     * Checa se a função de obter as despesas de um usuário está funcionando
     */
    public function test_get_user_expenses_function_ok(): void
    {
        $user = User::factory()->create();
        $expenses = Expense::factory(5)->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user, 'sanctum')
            ->getJson('/api/users/' . $user->id . '/expenses');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'message',

            'data' => [
                'expenses' => [
                    '*' => [
                        'id',
                        'user_id',
                        'description',
                        'amount',
                        'date',
                        '_links' => [
                            'self' => [
                                'href'
                            ],
                            'user' => [
                                'href'
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }

    /**
     * Checa se a função de obter as despesas de um usuário está retornando o erro correto
     */
    public function test_get_user_expenses_function_error(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->getJson('/api/users/' . $user->id + 1 . '/expenses');

        $response->assertNotFound()
            ->assertExactJson([
            'message' => 'Recurso não encontrado.'
        ]);
    }
}
