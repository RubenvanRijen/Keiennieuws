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
            $table->enum('size', ['A4', 'A5', 'A6', 'A7']);
            $table->string('email');
            $table->string('title');
            $table->text('information')->nullable(true);
            $table->foreignId('booking_id')->nullable(true)->constrained('bookings')->onDelete('cascade');
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
