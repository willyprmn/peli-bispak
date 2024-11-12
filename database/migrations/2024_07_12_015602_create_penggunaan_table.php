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
        Schema::create('penggunaan', function (Blueprint $table) {
            $table->bigIncrements('id_penggunaan');
            $table->unsignedBigInteger('pelanggan_id');
            $table->string('bulan', 2);
            $table->string('tahun', 4);
            $table->double('meter_awal');
            $table->double('meter_akhir');

            $table->foreign('pelanggan_id')->references('id_pelanggan')->on('pelanggan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunaan');
    }
};
