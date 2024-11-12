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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->bigIncrements('id_pembayaran');
            $table->unsignedBigInteger('tagihan_id');
            $table->double('jumlah_bayar');
            $table->string('bukti_bayar')->nullable();
            $table->string('bukti_nama')->nullable();

            $table->foreign('tagihan_id')->references('id_tagihan')->on('tagihan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
