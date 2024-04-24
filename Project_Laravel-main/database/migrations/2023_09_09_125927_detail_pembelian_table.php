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
        Schema::create('detail_pembelian', function (Blueprint $table) {
            $table->id('detail_pembelian_id');
            $table->unsignedBigInteger('detail_pembelian_pembelian_id');
            $table->unsignedBigInteger('detail_pembelian_pakaian_id');
            $table->integer('detail_pembelian_jumlah')->default(0);
            $table->integer('detail_pembelian_total_harga')->default(0);
            $table->timestamps();

            $table->foreign('detail_pembelian_pembelian_id')->references('pembelian_id')->on('pembelian')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('detail_pembelian_pakaian_id')->references('pakaian_id')->on('pakaian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pembelian');
    }
};