<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if (request()->isMethod('post')) {
            return [
                'id_user' => 'exists:users,id_user|required|int',
                'id_currency' => 'exists:currencies,id_currency|required|int',
                'balance' => 'required|numeric'
            ];
        } else {
            return [
                'id_user' => 'exists:users,id_user|nullable|int',
                'id_currency' => 'exists:currencies,id_currency|nullable|int',
                'balance' => 'nullable|numeric'
            ];
        }
    }
}
