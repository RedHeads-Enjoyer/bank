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
                'id_account' => 'required|int',
                'id_user' => 'required|date',
                'id_currency' => 'required|int',
                'balance' => 'required|int'
            ];
        } else {
            return [
                'id_account' => 'nullable|int',
                'id_user' => 'nullable|date',
                'id_currency' => 'nullable|int',
                'balance' => 'nullable|int'
            ];
        }
    }
}
