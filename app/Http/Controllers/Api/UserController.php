<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenseResource;
use App\Models\User;
use App\Traits\ApiResponserTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponserTrait;

    public function expenses(User $user): JsonResponse
    {
        return $this->success('Despesas do usuário "' . $user->name . '" listadas com sucesso.', [
            'expenses' => ExpenseResource::collection(auth()->user()->expenses),
        ]);
    }
}
