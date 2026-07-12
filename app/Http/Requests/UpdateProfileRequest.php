<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public bool $authorize = true;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = auth()->id();

        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $userId,
            'phone'    => 'required|string|max:20|unique:users,phone,' . $userId,
            'password' => 'nullable|string|min:6|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'  => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.unique'   => 'Email is already taken.',
            'phone.required' => 'Phone number is required.',
            'phone.unique'   => 'Phone number is already taken.',
            'password.min'   => 'Password must be at least 6 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ];
    }
}
