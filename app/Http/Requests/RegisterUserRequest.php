<?php

namespace App\Http\Requests;

use Core\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role'                  => 'required|in:buyer,farmer',
            'first_name'            => 'required|string|max:100',
            'last_name'             => 'required|string|max:100',
            'email'                 => 'required|email|unique:users,email',
           'phone_number' => 'nullable|numeric|max:11',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required',

            'farm_name'             => 'nullable|string|max:150', // ← required_if tinanggal
            'farm_barangay'         => 'nullable|string|max:100',
            'farm_description'      => 'nullable|string',
        ];
    }
}