<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'id_user' => $this->id_user,
      'first_name' => $this->first_name,
      'middle_name' => $this->middle_name,
      'last_name' => $this->last_name,
      'role' => $this->role,
      'phone' => $this->phone,
      'email' => $this->email,
      'password' => $this->password
    ];
  }
}
