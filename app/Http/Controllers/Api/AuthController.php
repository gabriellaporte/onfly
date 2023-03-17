<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Traits\ApiResponserTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponserTrait;

    public function login(LoginRequest $request): JsonResponse
    {
        if(!Auth::attempt($request->validated(), false)) {
            return $this->error('Credenciais inválidas', 401);
        }

        return $this->success('Login realizado com sucesso');
    }
}
