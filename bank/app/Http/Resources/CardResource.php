<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id_card' => $this->id_card,
            'number' => $this->number,
            'cvc' => $this->cvc,
            'id_account' => $this->id_account
        ];
    }
}