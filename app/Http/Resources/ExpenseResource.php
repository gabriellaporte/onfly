<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/*
|--------------------------------------------------------------------------
| ExpenseResource - Resource para a listagem de uma despesa
|--------------------------------------------------------------------------
|
| Camada Resource responsável para transformar as informações do Model em
| uma array que será usada em um JSON, na API. Segue o padrão HATEOAS.
|
*/

class ExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'description' => $this->description,
            'value' => $this->amount,
            'date' => $this->date,
            '_links' => [
                'self' => ['href' => route('api.expenses.show', $this->id)],
                'user' => ['href' => route('api.users.show', $this->user_id)],
            ],
        ];
    }
}
