<?php

namespace App\Http\Requests;

use App\Traits\ApiResponserTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

/*
|--------------------------------------------------------------------------
| LoginRequest - Validação para o login
|--------------------------------------------------------------------------
|
| Este é o Form Request responsável por lidar com as requisições para o login.
| Todas as regras estão descritas nos métodos e comentários.
|
*/

class LoginRequest extends FormRequest
{
    use ApiResponserTrait;

    /**
     * Autoriza a requisição
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras de validação
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required']
        ];
    }

    /**
     * Mensagens de erro
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.required' => 'O campo email é obrigatório',
            'email.email' => 'O campo email deve ser um e-mail válido',
            'password.required' => 'O campo senha é obrigatório'
        ];
    }

    /**
     * Retorna uma resposta de erro para o usuário, caso a validação falhe
     *
     * @param Validator $validator
     * @return JsonResponse
     */
    protected function failedValidation(Validator $validator): JsonResponse
    {
        throw new HttpResponseException(
            $this->error('Erro de validação', 422, $validator->errors()->toArray())
        );
    }

}
