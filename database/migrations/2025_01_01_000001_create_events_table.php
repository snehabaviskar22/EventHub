<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->date('event_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('venue');
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('available_seats');
            $table->date('booking_deadline');
            $table->text('eligible_programs')->nullable();
            $table->boolean('open_to_all')->default(false);
            $table->string('banner')->nullable();
            $table->string('audio')->nullable();
            $table->string('video')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
