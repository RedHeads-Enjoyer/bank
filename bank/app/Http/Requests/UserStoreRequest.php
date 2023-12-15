<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
  public function rules(): array
  {
    if (request()->isMethod('post')) {
      return [ 'first_name' => 'required|string',
        'middle_name' => 'nullable|string',
        'last_name' => 'required|string',
        'role' => 'required|int|max:2',
        'phone' => 'unique:users,phone|required|string',
        'email' => 'unique:users,email|required|string',
        'password' => 'required|string', ];
    } else {
      return [ 'first_name' => 'nullable|string',
        'middle_name' => 'nullable|string',
        'last_name' => 'nullable|string',
        'role' => 'nullable|int',
        'phone' => 'unique:users,phone|nullable|string',
        'email' => 'unique:users,email|nullable|string',
        'password' => 'nullable|string', ];
    }
  }
}
