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
        Schema::create('paket_umrahs', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('kode_paket', 25)->unique();
            $table->string('nama_paket', 255);
            $table->text('gambar');
            $table->text('deskripsi');
            $table->date('tanggal_keberangkatan');
            $table->date('tanggal_akhir_pendaftaran');
            $table->string('paket_tersedia', 25);
            $table->string('total_hari', 25);
            $table->string('pajak_bandara', 25);
            $table->string('bus_bandara', 25);
            $table->string('pembimbing', 25);
            $table->string('contact_person', 25);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_umrahs');
    }
};
