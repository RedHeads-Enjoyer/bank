<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardStoreRequest extends FormRequest
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
                'number' => 'required|string|regex:/^[0-9]{4} [0-9]{4} [0-9]{4} [0-9]{4}$/',
                'cvc' => 'required|string|regex:/^\d{3}$/',
                'id_account' => 'exists:accounts,id_account|required|int',
            ];
        } else {
            return [
                'number' => 'nullable|string|regex:/^\d{4} \d{4} \d{4} \d{4}$/',
                'cvc' => 'nullable|string|regex:/^\d{3}$/',
                'id_account' => 'exists:accounts,id_account|nullable|int',
            ];
        }
    }
}
