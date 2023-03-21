<?php

namespace Tests\Feature\Endpoints;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExpenseEndpointTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste de endpoint de despesa, deve retornar ok
     *
     * @return void
     */
    public function test_get_expense_endpoint_ok(): void
    {
        $user = User::factory()->create();

        $expense = Expense::factory([
            'user_id' => $user->id,
        ])->create();

        $this->actingAs($user, 'sanctum')
            ->getJson('api/expenses/' . $expense->id)
            ->assertOk();
    }

    /**
     * Teste de endpoint de despesa não logado, deve retornar 401
     *
     * @return void
     */
    public function test_get_expense_endpoint_without_auth(): void
    {
        $user = User::factory()->create();

        $expense = Expense::factory([
            'user_id' => $user->id,
        ])->create();

        $this->getJson('api/expenses/' . $expense->id)
            ->assertStatus(401);
    }

    /**
     * Teste de endpoint de despesa, deve retornar 404
     *
     * @return void
     */
    public function test_get_expense_endpoint_not_found(): void
    {
        $user = User::factory()->create();

        $expense = Expense::factory([
            'user_id' => $user->id,
        ])->create();

        $this->actingAs($user, 'sanctum')
            ->getJson('api/expenses/999')
            ->assertNotFound();
    }

    /**
     * Teste de endpoint de despesa, deve retornar 403
     *
     * @return void
     */
    public function test_get_expense_endpoint_forbidden(): void
    {
        $user = User::factory()->create();

        $expense = Expense::factory([
            'user_id' => $user->id,
        ])->create();

        $user2 = User::factory()->create();

        $this->actingAs($user2, 'sanctum')
            ->getJson('api/expenses/' . $expense->id)
            ->assertForbidden();
    }
}
