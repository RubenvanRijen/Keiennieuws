<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['advertisement', 'column', 'newsFeed', 'eventPoster', 'knowledge', 'article', 'sponsorship']);
            $table->string('email');
            $table->string('title');
            $table->text('information')->nullable(true);
            $table->boolean("noBooking")->nullable(true);
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publications');
    }
};