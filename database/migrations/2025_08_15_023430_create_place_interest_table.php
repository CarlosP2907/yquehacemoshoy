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
        Schema::create('place_interest', function (Blueprint $table) {
            $table->unsignedBigInteger('place_id');
            $table->unsignedBigInteger('interest_id');
            $table->primary(['place_id', 'interest_id']);
            $table->timestamps();


            $table->foreign('place_id')->references('id')->on('place')->onDelete('cascade');
            $table->foreign('interest_id')->references('id')->on('interests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('place_interest');
    }
};
