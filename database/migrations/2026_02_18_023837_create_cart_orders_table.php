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
        Schema::create('cart_orders', function (Blueprint $table) {
    $table->id('cartID');
    $table->foreignId('userID')
          ->constrained('users', 'userID')
          ->cascadeOnDelete();
    $table->foreignId('ticketID')
          ->constrained('tickets', 'ticketID')
          ->cascadeOnDelete();
    $table->integer('quantity');
    $table->timestamp('date_purchased')->nullable();
    $table->string('status')->default('pending'); // pending, paid, cancelled
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_orders');
    }
};
