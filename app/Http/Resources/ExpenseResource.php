<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'description' => $this->description,
            'value' => $this->value,
            'date' => $this->created_at,
            'relationships' => [
                'user' => [
                    'href' => '/users/' . $this->user_id,
                    'method' => 'GET'
                ]
            ]
        ];
    }
}