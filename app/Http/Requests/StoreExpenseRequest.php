<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
{
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
            'description' => 'required|string|max:191',
            'user_id' => 'required|integer|exists:users,id',
            'amount' => 'required|numeric|min:0|different:0',
            'date' => 'nullable|date_format:Y-m-d H:i:s',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
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
            'description.required' => 'A descrição  é obrigatória.',
            'description.string' => 'A descrição  deve ser uma string.',
            'description.max' => 'A descrição deve ter no máximo 191 caracteres.',
            'user_id.required' => 'O ID do usuário é obrigatório.',
            'user_id.integer' => 'O usuário é inválido.',
            'user_id.exists' => 'O usuário informado não existe.',
            'amount.required' => 'O valor da despesa é obrigatório.',
            'amount.numeric' => 'O valor da despesa deve ser um número.',
            'amount.min' => 'O valor da despesa deve ser maior que 0.',
            'amount.different' => 'O valor da despesa deve ser maior que 0.',
            'date.date_format' => 'O valor da despesa deve estar no formato Y-m-d H:i:s.',
        ];
    }

    /**
     * Prepara as entradas para validação
     *
     * @return void
     */
    public function prepareForValidation(): void
    {
        $this->merge([
            'created_at' => $this->date ?? now()->format('Y-m-d H:i:s'),
            'updated_at' => $this->date ?? now()->format('Y-m-d H:i:s'),
        ]);
    }
}
