<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{
    // Правила преобразования
    public function toArray(Request $request): array
    {
        return [
            'id_account' => $this->id_account,
            'id_user' => $this->id_user,
            'id_currency' => $this->id_currency,
            'balance' => $this->balance
        ];
    }
}
