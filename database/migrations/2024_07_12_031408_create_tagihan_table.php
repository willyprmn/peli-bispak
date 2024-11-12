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
        Schema::create('tagihan', function (Blueprint $table) {
            $table->bigIncrements('id_tagihan');
            $table->unsignedBigInteger('penggunaan_id');
            $table->unsignedBigInteger('pelanggan_id');
            $table->double('jumlah_meter');
            $table->string('status', 20);

            $table->foreign('penggunaan_id')->references('id_penggunaan')->on('penggunaan');
            $table->foreign('pelanggan_id')->references('id_pelanggan')->on('pelanggan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan');
    }
};
