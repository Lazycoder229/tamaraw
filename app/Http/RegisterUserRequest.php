<?php

namespace App\Http\Requests;

use Core\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Public registration — anyone may attempt to sign up.
     * (Contrast with StoreUserRequest, which is admin-only.)
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules applied before the controller action runs.
     *
     * NOTE: farm_name/farm_barangay/farm_description use `required_if:role,farmer`
     * — verify your Validator supports this rule name. If it doesn't, swap these
     * for a manual check in the controller/service instead (see note below).
     */
    public function rules(): array
    {
        return [
            'role'                  => 'required|in:buyer,farmer',
            'first_name'            => 'required|string|max:100',
            'last_name'             => 'required|string|max:100',
            'email'                 => 'required|email|unique:users,email',
            'phone_number'          => 'nullable|string|max:20',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required',

            // Farm profile fields — only enforced when role = farmer
            'farm_name'             => 'required_if:role,farmer|string|max:150',
            'farm_barangay'         => 'nullable|string|max:100',
            'farm_description'      => 'nullable|string',
        ];
    }
}