<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/*
|--------------------------------------------------------------------------
| RegisterRequest - Validação para o registro
|--------------------------------------------------------------------------
|
| Este é o Form Request responsável por lidar com as requisições para o
| registro. Todas as regras estão descritas nos métodos e comentários.
|
*/

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
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
            'name.max' => 'O nome deve ter no máximo 255 caracteres',
            'email.required' => 'O campo email é obrigatório',
            'email.email' => 'O e-mail informado não é válido',
            'email.unique' => 'O e-mail informado já está em uso',
            'email.max' => 'O e-mail deve ter no máximo 255 caracteres',
            'password.required' => 'O campo password é obrigatório',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres',
            'password.max' => 'A senha deve ter no máximo 255 caracteres',
        ];
    }
}
