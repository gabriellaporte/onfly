<?php

namespace App\Http\Requests;

use App\Traits\ApiResponserTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class LoginRequest extends FormRequest
{
    use ApiResponserTrait;

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras de validação para o login
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    /**
     * Mensagens de erro para o login
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.required' => 'O campo "email" é obrigatório',
            'email.email' => 'O campo "email" deve ser um e-mail válido',
            'password.required' => 'O campo "senha" é obrigatório'
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
