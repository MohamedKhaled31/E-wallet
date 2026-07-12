<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wallet_id',
        'amount',
        'method',
        'account_details',
        'status',
        'admin_note',
        'processed_at',
    ];

    protected $casts = [
        'account_details' => 'array',
        'processed_at' => 'datetime',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function wallet() { return $this->belongsTo(Wallet::class); }

    public function transactions()
    {
        return $this->morphMany(WalletTransaction::class, 'reference');
    }
}
