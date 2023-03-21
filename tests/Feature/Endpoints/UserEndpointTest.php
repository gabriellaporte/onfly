<?php

namespace Tests\Feature\Endpoints;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserEndpointTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste de endpoint de usuário, deve retornar ok
     *
     * @return void
     */
    public function test_get_user_endpoint(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->getJson('api/users/' . $user->id)
            ->assertOk();
    }

    /**
     * Teste de endpoint de usuário não logado, deve retornar 401
     *
     * @return void
     */
    public function test_get_user_endpoint_without_auth(): void
    {
        $user = User::factory()->create();

        $this->getJson('api/users/' . $user->id)
            ->assertStatus(401);
    }
}
