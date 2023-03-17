<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExpensesEndpointTest extends TestCase
{
    /**
     * Checa se o endpoint de despesas está retornando o status 200.
     *
     * @return void
     */
    public function test_is_expenses_index_endpoint_available(): void
    {
        $response = $this->getJson('/api/expenses');

        $response->assertStatus(200);
    }
}
