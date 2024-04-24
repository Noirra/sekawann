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
        Schema::create('review', function (Blueprint $table) {
            $table->id('review_id');
            $table->unsignedBigInteger('review_pakaian_id');
            $table->unsignedBigInteger('review_user_id');
            $table->integer('revies_rating')->default(0);
            $table->string('review_note', 200);
            $table->timestamps();

            $table->foreign('review_pakaian_id')->references('pakaian_id')->on('pakaian')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('review_user_id')->references('user_id')->on('user')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review');
    }
};