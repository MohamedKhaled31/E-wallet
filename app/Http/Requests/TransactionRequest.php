<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type'   => ['nullable', 'string', 'in:top_up,transfer,withdrawal_pending,withdrawal_completed'],
            'from'   => ['nullable', 'date'],
            'to'     => ['nullable', 'date', 'after_or_equal:from'],
            'ref'    => ['nullable', 'string', 'max:50'],
        ];
    }
}
