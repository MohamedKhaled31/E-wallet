<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id',
        'related_wallet_id',
        'type',
        'direction',
        'amount',
        'balance_before',
        'balance_after',
        'description',
        'reference_type',
        'reference_id',
        'status',
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
    public function receiver()
    {
        return $this->belongsTo(User::class, 'related_wallet_id');
    }

    public function reference()
    {
        return $this->morphTo();
    }
}
