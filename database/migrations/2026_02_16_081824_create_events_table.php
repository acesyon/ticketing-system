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
        Schema::create('events', function (Blueprint $table) {
            $table->increments('eventID');
            $table->string('event_name');
            $table->text('description');
            $table->string('location');
            $table->date('eventDate');
            $table->time('eventTime');
            $table->string('status')->default('active'); // 'active','cancelled','completed'
            $table->timestamps();
        });

        Schema::create('event_attendees', function (Blueprint $table) {
            $table->increments('attendeeID');
            $table->integer('eventID')->unsigned();
            $table->foreign('eventID')->references('eventID')->on('events');
            $table->integer('userID')->unsigned();
            $table->foreign('userID')->references('userID')->on('users');
        });

        Schema::create('event_comments', function (Blueprint $table) {
            $table->increments('commentID');
            $table->integer('eventID')->unsigned();
            $table->foreign('eventID')->references('eventID')->on('events');
            $table->integer('userID')->unsigned();
            $table->foreign('userID')->references('userID')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
