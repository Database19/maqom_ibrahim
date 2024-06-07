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
        Schema::create('daftar_umrah_details', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->char('daftar_umrah_id', 36);
            $table->string('no_pendaftaran', 50)->unique();
            $table->string('kode_paket', 25);
            $table->string('no_pembayaran', 25);
            $table->string('jenis_pembayaran', 25);
            $table->string('total_biaya', 25);
            $table->string('tanda_bukti', 25);
            $table->string('keterangan', 25);
            // $table->foreignId('paket_umrah_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_umrah_details');
    }
};
