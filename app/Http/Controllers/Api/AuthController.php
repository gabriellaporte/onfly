<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponserTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponserTrait;

    /**
     * Faz o login do usuário e retorna o token
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if(!Auth::attempt($request->validated(), false)) {
            return $this->error('Credenciais inválidas', 401);
        }

        $token = auth()->user()->createToken('auth_token')->plainTextToken;

        return $this->success('Login realizado com sucesso', [
            'userID' => auth()->user()->id,
            'token' => $token
        ]);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success('Usuário criado com sucesso', [
            'userID' => $user->id,
            'token' => $token,
            'userInfo' => (new UserResource($user))
        ], 201);
    }
}
