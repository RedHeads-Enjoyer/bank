<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
                'id_currency' => 'required|int',
                'title' => 'required|string',
                'rate' => 'required|double',
            ];
        } else {
            return [
                'id_currency' => 'nullable|int',
                'title' => 'nullable|string',
                'rate' => 'nullable|double',
            ];
        }
    }
}
