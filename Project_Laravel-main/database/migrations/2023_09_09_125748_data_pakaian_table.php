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
        Schema::create('pakaian', function (Blueprint $table) {
            $table->id('pakaian_id');
            $table->unsignedBigInteger('pakaian_kategori_pakaian_id');
            $table->string('pakaian_nama', 50);
            $table->integer('pakaian_harga')->default(0);
            $table->integer('pakaian_stok')->default(0);
            $table->string('pakaian_gambar_url')->nullable(true);
            $table->timestamps();

            $table->foreign('pakaian_kategori_pakaian_id')->references('kategori_pakaian_id')->on('kategori_pakaian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakaian');
    }
};