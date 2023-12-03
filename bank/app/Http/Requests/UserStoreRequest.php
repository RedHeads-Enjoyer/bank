<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
                'first_name' => 'required|string',
                'middle_name' => 'nullable|string',
                'last_name' => 'required|string',
                'role' => 'required|int|max:2',
                'phone' => 'required|string',
                'email' => 'required|string',
                'password' => 'required|string',
            ];
        } else {
            return [
                'first_name' => 'nullable|string',
                'middle_name' => 'nullable|string',
                'last_name' => 'nullable|string',
                'role' => 'nullable|int',
                'phone' => 'nullable|string',
                'email' => 'nullable|string',
                'password' => 'nullable|string',
            ];
        }
    }
}
