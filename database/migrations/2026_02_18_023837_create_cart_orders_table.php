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
            $table->increments('cartID');
            $table->unsignedInteger('userID');
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
            $table->unsignedInteger('ticketID');
            $table->foreign('ticketID')->references('ticketID')->on('tickets')->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamp('date_purchased')->nullable();
            $table->string('status')->default('pending'); // 'pending','paid','cancelled'
            $table->timestamps();
        });

        Schema::create('cart_items', function (Blueprint $table) {
            $table->increments('itemID');
            $table->unsignedInteger('cartID');
            $table->foreign('cartID')->references('cartID')->on('cart_orders')->onDelete('cascade');
            $table->unsignedInteger('ticketID');
            $table->foreign('ticketID')->references('ticketID')->on('tickets')->onDelete('cascade');
        });

        Schema::create('cart_item_quantities', function (Blueprint $table) {
            $table->increments('quantityID');
            $table->unsignedInteger('itemID');
            $table->foreign('itemID')->references('itemID')->on('cart_items')->onDelete('cascade');
            $table->integer('quantity');
        });

        Schema::create('cart_item_prices', function (Blueprint $table) {
            $table->increments('priceID');
            $table->unsignedInteger('itemID');
            $table->foreign('itemID')->references('itemID')->on('cart_items')->onDelete('cascade');
            $table->decimal('price', 8, 2);
        });

        Schema::create('cart_item_totals', function (Blueprint $table) {
            $table->increments('totalID');
            $table->unsignedInteger('itemID');
            $table->foreign('itemID')->references('itemID')->on('cart_items')->onDelete('cascade');
            $table->decimal('total', 8, 2);
        });

        Schema::create('cart_item_discounts', function (Blueprint $table) {
            $table->increments('discountID');
            $table->unsignedInteger('itemID');
            $table->foreign('itemID')->references('itemID')->on('cart_items')->onDelete('cascade');
            $table->decimal('discount', 8, 2);
        });

        Schema::create('cart_item_taxes', function (Blueprint $table) {
            $table->increments('taxID');
            $table->unsignedInteger('itemID');
            $table->foreign('itemID')->references('itemID')->on('cart_items')->onDelete('cascade');
            $table->decimal('tax', 8, 2);
        });

        Schema::create('cart_item_subtotals', function (Blueprint $table) {
            $table->increments('subtotalID');
            $table->unsignedInteger('itemID');
            $table->foreign('itemID')->references('itemID')->on('cart_items')->onDelete('cascade');
            $table->decimal('subtotal', 8, 2);
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
