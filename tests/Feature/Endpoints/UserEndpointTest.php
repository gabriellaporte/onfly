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
    public function test_get_user_endpoint_ok(): void
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

    /**
     * Teste de endpoint de usuário, deve retornar 404
     *
     * @return void
     */
    public function test_get_user_endpoint_not_found(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->getJson('api/users/999')
            ->assertNotFound();
    }

    /**
     * Teste de endpoint de usuário, deve retornar 403
     *
     * @return void
     */
    public function test_get_user_endpoint_forbidden(): void
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->getJson('api/users/' . $user2->id)
            ->assertForbidden();
    }

}
