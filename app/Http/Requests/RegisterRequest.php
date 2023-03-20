<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
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
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];
    }

    /**
     * Mensagens de erro
     *
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O campo name é obrigatório',
            'email.required' => 'O campo email é obrigatório',
            'email.email' => 'O e-mail informado não é válido',
            'email.unique' => 'O e-mail informado já está em uso',
            'password.required' => 'O campo password é obrigatório',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres',
        ];
    }
}
