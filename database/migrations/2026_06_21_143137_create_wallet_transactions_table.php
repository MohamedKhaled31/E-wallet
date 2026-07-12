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
    Schema::create('wallet_transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('wallet_id')->constrained()->onDelete('cascade');
        $table->unsignedBigInteger('related_wallet_id')->nullable();
        $table->string('type');
        $table->string('direction');
        $table->decimal('amount', 15, 2);
        $table->decimal('balance_before', 15, 2);
        $table->decimal('balance_after', 15, 2);
        $table->string('description')->nullable();
        $table->string('status')->default('completed');
        $table->morphs('reference');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_transactions');
    }
};
