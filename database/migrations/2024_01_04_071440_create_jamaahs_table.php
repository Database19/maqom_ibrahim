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
        Schema::create('jamaahs', function (Blueprint $table) {
            $table->char('id', 36)->primary(); // Removed ->nullable()
            $table->string('no_ktp', 20);
            $table->string('nama_lengkap', 255);
            $table->string('jenis_kelamin', 24);
            $table->string('status_pernikahan', 24);
            $table->longText('foto')->nullable();
            $table->string('nama_foto', 255);
            $table->string('tempat_lahir', 255);
            $table->date('tanggal_lahir');
            $table->integer('usia');
            $table->string('kewarganegaraan', 50);
            $table->string('golongan_darah', 24);
            $table->string('nama_relasi', 255);
            $table->string('role_relasi', 50);
            $table->text('alamat_lengkap');
            $table->text('alamat_lengkap2');
            $table->string('provinsi', 50);
            $table->string('kota', 50);
            $table->string('kecamatan', 50);
            $table->string('kelurahan', 50);
            $table->string('rw', 5);
            $table->string('rt', 5);
            $table->string('kodepos', 10);
            $table->string('no_telp', 20);
            $table->string('email', 255);
            $table->string('nama_sekolah', 255);
            $table->text('alamat_sekolah');
            $table->string('pendidikan', 50);
            $table->string('tempat_kerja', 255);
            $table->string('nama_bagian', 255);
            $table->string('profesi', 255);
            $table->text('members');
            $table->boolean('is_deleted');
            $table->boolean('is_register')->default(0);
            $table->char('parent_id', 36)->nullable();
            $table->foreign('parent_id')
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
        Schema::table('jamaahs', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
        });

        Schema::dropIfExists('jamaahs');
    }
};
