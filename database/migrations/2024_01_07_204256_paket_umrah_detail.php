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
        Schema::create('paket_umrah_details', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->char('id_paket_umrah', 36);
            $table->string('kode_paket', 25);
            $table->string('jenis_kamar', 25);
            $table->string('harga_paket', 25);
            $table->string('hotel_mekkah', 25);
            $table->string('hotel_madinah', 25);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_umrah_details');
    }
};
