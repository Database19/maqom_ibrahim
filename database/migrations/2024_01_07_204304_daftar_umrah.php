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
        Schema::create('daftar_umrahs', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('no_pendaftaran', 50)->unique();
            $table->date('tanggal_pendaftaran');
            $table->char('jamaah_id', 36);
            $table->string('no_ktp', 25);
            $table->string('nama_relasi', 255);
            $table->string('kode_paket_umrah', 25);
            $table->string('total_biaya', 25);
            $table->string('tipe_bayar', 25);
            $table->string('jenis_bayar', 25);
            $table->string('total_bayar', 25);
            $table->string('status_pembayaran', 25);
            $table->string('total_pembayaran', 25);
            $table->foreign('kode_paket_umrah')
                ->references('kode_paket')->on('paket_umrahs')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('jamaah_id')
                ->references('id')->on('jamaahs')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_umrahs');
    }
};
