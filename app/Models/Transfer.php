<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'sender_wallet_id',
        'receiver_id',
        'receiver_wallet_id',
        'amount',
        'reference',
        'status',
    ];

    public function sender() { return $this->belongsTo(User::class, 'sender_id'); }
    public function receiver() { return $this->belongsTo(User::class, 'receiver_id'); }
    public function senderWallet() { return $this->belongsTo(Wallet::class, 'sender_wallet_id'); }
    public function receiverWallet() { return $this->belongsTo(Wallet::class, 'receiver_wallet_id'); }


    public function transactions() 
    {
        return $this->morphMany(WalletTransaction::class, 'reference');
    }
}
