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
                'number' => 'required|int|min:1000000000000000|max:9999999999999999',
                'cvc' => 'required|int|max:999|min:100',
                'id_account' => 'required|int',
            ];
        } else {
            return [
                'number' => 'nullable|int|min:1000000000000000|max:9999999999999999',
                'cvc' => 'nullable|int|max:999|min:100',
                'id_account' => 'nullable|int',
            ];
        }
    }
}
