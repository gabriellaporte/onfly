<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenseResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponserTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponserTrait;

    /**
     * Lista as informações do usuário
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return $this->success('Usuário "' . $user->name . '" listado com sucesso.', new UserResource($user));
    }

    /**
     * Lista as despesas do usuário
     *
     * @param User $user        Usuário
     * @return JsonResponse     Lista de despesas do usuário
     */
    public function expenses(User $user): JsonResponse
    {
        return $this->success('Despesas do usuário "' . $user->name . '" listadas com sucesso.', [
            'expenses' => ExpenseResource::collection(auth()->user()->expenses)
        ]);
    }
}
