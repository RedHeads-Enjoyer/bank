<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OperationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_operation' => $this->id_operation,
            'delta' => $this->delta,
            'date' => $this->date,
            'id_account' => $this->id_account,
        ];
    }
}
