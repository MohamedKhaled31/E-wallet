<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
        'receiver_email' => 'required|email|exists:users,email',
        'amount'         => 'required|numeric|min:10',
        'reference'      => 'nullable|string|max:255',
    ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->receiver_email === auth()->user()->email) {
                $validator->errors()->add('receiver_email', 'You cannot transfer money to yourself.');
            }
        });
    }

    public function messages(): array
    {
        return [
            'receiver_email.required'  => 'Receiver email is required.',
            'receiver_email.email'    => 'Please enter a valid email address.',
            'receiver_email.exists'   => 'Receiver email not found.',
            'amount.required' => 'Amount is required.',
            'amount.numeric'  => 'Amount must be a number.',
            'amount.min'      => 'Minimum transfer is 10 EGP.',
        ];
    }
}
