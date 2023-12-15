<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountStoreRequest extends FormRequest
{
    // Проверка на доступность
    public function authorize(): bool
    {
        return true;
    }

    // Правила валидации
    public function rules(): array
    {
        if (request()->isMethod('post')) {
            return [
                'id_currency' => 'exists:currencies,id_currency|required|int',
                'balance' => 'required|numeric'
            ];
        } else {
            return [
                'id_currency' => 'exists:currencies,id_currency|nullable|int',
                'balance' => 'nullable|numeric'
            ];
        }
    }
}
