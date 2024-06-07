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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('nama_depan', 25);
            $table->string('nama_belakang', 25);
            $table->string('tempat_lahir', 25);
            $table->string('jabatan', '25');
            $table->string('tanggal_lahir', 25);
            $table->string('jenis_kelamin', 25);
            $table->text('alamat');
            $table->string('no_hp', 25);
            $table->string('email', 50)->unique();
            $table->string('status', 15);
            $table->boolean('is_deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
