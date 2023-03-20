<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpenseRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return $this->resolveRulesForMethod();
    }

    /**
     * Mensagens de erro
     *
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'description.required' => 'A descrição é obrigatória.',
            'description.string' => 'A descrição deve ser uma string.',
            'description.max' => 'A descrição deve ter no máximo 191 caracteres.',
            'amount.required' => 'O valor da despesa é obrigatório.',
            'amount.numeric' => 'O valor da despesa deve ser um número.',
            'amount.min' => 'O valor da despesa deve ser maior que 0.',
            'amount.not_in' => 'O valor da despesa deve ser maior que 0.',
            'date.required' => 'A data da despesa é obrigatória.',
            'date.date_format' => 'A data da despesa deve estar no formato Y-m-d H:i:s.',
            'date.before_or_equal' => 'A data da despesa não pode ser futura.'
        ];
    }

    /**
     * Atribui ao FormRequest as regras de validação conforme o método HTTP
     *
     * @return array
     */
    private function resolveRulesForMethod(): array
    {
        if($this->isMethod('PUT')) {
            return $this->putRules();
        }

        return $this->patchRules();
    }

    /**
     * Regras relacionadas à atualização completa de uma despesa (PUT)
     *
     * @return string[]
     */
    private function putRules(): array
    {
        return [
            'description' => 'required|string|max:191',
            'amount' => 'required|numeric|min:0|not_in:0',
            'date' => 'required|date_format:Y-m-d H:i:s|before_or_equal:now',
        ];
    }

    /**
     * Regras relacionadas à atualização parcial de uma despesa (PATCH)
     *
     * @return string[]
     */
    private function patchRules(): array
    {
        return [
            'description' => 'nullable|string|max:191',
            'amount' => 'nullable|numeric|min:0|not_in:0',
            'date' => 'nullable|date_format:Y-m-d H:i:s|before_or_equal:now',
        ];
    }
}
