<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenseResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponserTrait;
use Illuminate\Http\JsonResponse;

/*
|--------------------------------------------------------------------------
| UserController - Requisições relacionadas ao usuário
|--------------------------------------------------------------------------
|
| Aqui é o Controller responsável por lidar com as requisições para um user,
| com funções simples, como listar informações e despesas do usuário. Se
| você procura por funções de autenticação, veja AuthController.
|
*/

class UserController extends Controller
{
    use ApiResponserTrait;

    /**
     * Construtor do Controller, distribui as permissões de acesso (ACL) para as funções
     */
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user'); // App\Policies\UserPolicy
    }

    /**
     * Adiciona o método "expenses" ao mapeamento da função authorizeResource, usada no construtor
     *
     * @return array
     */
    protected function resourceAbilityMap(): array
    {
        return array_merge(parent::resourceAbilityMap(), [
            'expenses' => 'view'
        ]);
    }

    /**
     * Lista as informações do usuário
     *
     * @param User $user        [Usuário]
     * @return JsonResponse     [Informações do usuário, UserResource]
     */
    public function show(User $user): JsonResponse
    {
        return $this->success('Usuário listado com sucesso.',
            (new UserResource($user))
        );
    }

    /**
     * Lista as despesas do usuário
     *
     * @param User $user        [Usuário]
     * @return JsonResponse     [Lista de despesas do usuário, ExpenseResource (Collection)]
     */
    public function expenses(User $user): JsonResponse
    {
        return $this->success('Despesas do usuário listadas com sucesso.', [
            'expenses' => ExpenseResource::collection($user->expenses)
        ]);
    }
}
