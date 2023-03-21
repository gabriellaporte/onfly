<?php

namespace Tests\Feature;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExpenseControllerTest extends TestCase
{
    /**
     * Checa se a função de obter uma despesa está funcionando
     */
    public function test_get_expense_function_ok(): void
    {
        $user = User::factory()->create();
        $expense = Expense::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user, 'sanctum')
            ->getJson('/api/expenses/' . $expense->id);

        $response->assertOk()
            ->assertJsonFragment([
                'id' => $expense->id,
                'user_id' => $expense->user_id,
                'description' => $expense->description,
            ]);
    }

    /**
     * Checa se a função de criar uma despesa está funcionando
     */
    public function test_create_expense_function_ok(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/expenses', [
                'description' => 'Teste',
                'amount' => 100
            ]);

        $response->assertCreated()
            ->assertJsonFragment([
                'description' => 'Teste',
                'amount' => 100.0,
            ]);
    }

    /**
     * Checa se a função de atualizar uma despesa está funcionando
     */
    public function test_update_expense_function_ok(): void
    {
        $user = User::factory()->create();
        $expense = Expense::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user, 'sanctum')
            ->putJson('/api/expenses/' . $expense->id, [
                'description' => 'Teste',
                'amount' => 100,
                'date' => now()->format('Y-m-d H:i:s')
            ]);

        $response->assertOk()
            ->assertJsonFragment([
                'description' => 'Teste',
                'amount' => 100.0,
                'date' => now()->format('Y-m-d H:i:s')
            ]);
    }

    /**
     * Checa se a função de deletar uma despesa está funcionando
     */
    public function test_delete_expense_function_ok(): void
    {
        $user = User::factory()->create();
        $expense = Expense::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user, 'sanctum')
            ->deleteJson('/api/expenses/' . $expense->id);

        $response->assertNoContent();
    }
}
