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

/*
|--------------------------------------------------------------------------
| AuthController - Autenticação de usuários na API
|--------------------------------------------------------------------------
|
| Aqui é o Controller responsável por lidar com as requisições para login e
| registro na API da Onfly. Essas funções são acessadas pelas rotas de API
| em routes/api_authentication.php.
|
*/

class AuthController extends Controller
{
    use ApiResponserTrait;

    /**
     * Faz o login do usuário e retorna o token
     *
     * @param LoginRequest $request     [Form Request com as regras de validação]
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

    /**
     * Faz o registro, login e retorna o token e informações do usuário
     *
     * @param RegisterRequest $request  [Form Request com as regras de validação]
     * @return JsonResponse
     */
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
