<?php

namespace Tests\Feature\Endpoints;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExpensesEndpointTest extends TestCase
{
    /**
     * Checa se o endpoint de despesas está disponível
     *
     * @return void
     */
    public function test_is_expenses_index_endpoint_available(): void
    {
        $response = $this->getJson('/api/expenses');

        $response->assertStatus(200);
    }
}
