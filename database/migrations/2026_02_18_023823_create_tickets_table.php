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
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('ticketID');
            $table->unsignedInteger('eventID');
            $table->foreign('eventID')->references('eventID')->on('events')->onDelete('cascade');
            $table->string('ticketType');
            $table->decimal('price', 8, 2);
            $table->integer('quantity_available');
            $table->timestamps();
        });

        Schema::create('ticket_purchases', function (Blueprint $table) {
            $table->increments('purchaseID');
            $table->unsignedInteger('ticketID');
            $table->foreign('ticketID')->references('ticketID')->on('tickets')->onDelete('cascade');
            $table->unsignedInteger('userID');
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
        });

        Schema::create('ticket_reservations', function (Blueprint $table) {
            $table->increments('reservationID');
            $table->unsignedInteger('ticketID');
            $table->foreign('ticketID')->references('ticketID')->on('tickets')->onDelete('cascade');
            $table->unsignedInteger('userID');
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
        });

        Schema::create('ticket_cancellations', function (Blueprint $table) {
            $table->increments('cancellationID');
            $table->unsignedInteger('ticketID');
            $table->foreign('ticketID')->references('ticketID')->on('tickets')->onDelete('cascade');
            $table->unsignedInteger('userID');
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
        });

        Schema::create('ticket_exchanges', function (Blueprint $table) {
            $table->increments('exchangeID');
            $table->unsignedInteger('ticketID');
            $table->foreign('ticketID')->references('ticketID')->on('tickets')->onDelete('cascade');
            $table->unsignedInteger('userID');
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
        });

        Schema::create('ticket_refunds', function (Blueprint $table) {
            $table->increments('refundID');
            $table->unsignedInteger('ticketID');
            $table->foreign('ticketID')->references('ticketID')->on('tickets')->onDelete('cascade');
            $table->unsignedInteger('userID');
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
        });

        Schema::create('ticket_returns', function (Blueprint $table) {
            $table->increments('returnID');
            $table->unsignedInteger('ticketID');
            $table->foreign('ticketID')->references('ticketID')->on('tickets')->onDelete('cascade');
            $table->unsignedInteger('userID');
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
