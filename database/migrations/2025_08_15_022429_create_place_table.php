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
        Schema::create('place', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->unsignedBigInteger('place_type_id');
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('image')->nullable();

            $table->string('phone')->nullable();
            $table->string('website')->nullable();

            $table->enum('status', ['open', 'closed'])->default('open');

            $table->decimal('rating', 10, 2)->nullable();
            $table->decimal('price_range', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('place_type_id')->references('id')->on('place_type')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('place');
    }
};
