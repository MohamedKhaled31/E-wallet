<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('top_ups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('wallet_id')->constrained('wallets')->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->string('currency', 10)->default('EGP');
            $table->string('gateway')->default('Stripe');
            $table->string('gateway_transaction_id')->nullable()->unique();
            $table->enum('status', ['pending', 'paid', 'failed', 'cancelled'])->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_ups');
    }
};
