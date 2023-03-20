<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/*
|--------------------------------------------------------------------------
| UserResource - Resource para a listagem de um usuário (show)
|--------------------------------------------------------------------------
|
| Camada Resource responsável para transformar as informações do Model em
| uma array que será usada em um JSON, na API. Segue o padrão HATEOAS.
|
*/

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            '_links' => [
                'self' => ['href' => route('api.users.show', $this->id)],
                'expenses' => ['href' => route('api.users.expenses', $this->id)],
            ],
        ];
    }
}
