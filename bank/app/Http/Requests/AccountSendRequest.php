<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountSendRequest extends FormRequest
{
  // Проверка на доступность
  public function authorize(): bool
  {
    return true;
  }

  // Правила валидации
  public function rules(): array
  {
    return [
      'id_from' => 'exists:accounts,id_account|required|int',
      'id_to' => 'exists:accounts,id_account|required|int',
      'sum' => 'required|numeric|min:0.01'
    ];
  }
}
