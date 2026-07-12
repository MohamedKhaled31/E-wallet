<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WithdrawRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'amount' => ['required', 'numeric', 'min:50'],
            'method' => ['required', 'in:Bank transfer,Vodafone Cash,Instapay'],
            'account_details' => ['required', 'array'],
            'account_details.number' => ['required', 'string'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!auth()->user()->wallet) {
                $validator->errors()->add('amount', 'Wallet not found.');
                return;
            }
            if ($this->amount > auth()->user()->wallet->balance) {
                $validator->errors()->add('amount', 'Insufficient balance for this withdrawal.');
            }
        });
    }
}
