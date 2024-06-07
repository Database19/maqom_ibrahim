<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaketUmrahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jabatan = new JabatanSeeder();
        $jabatan->run();

        $karyawan = new KaryawanSeeder();
        $karyawan->run();

        foreach (range(1, 5) as $_) {
            $paketUmrahId = \Ramsey\Uuid\Uuid::uuid4()->toString();
            $paketUmrahKode = fake()->unique()->regexify('[A-Z0-9]{5}');
            $pembimbing = DB::table('karyawans')->inRandomOrder()->first();

            DB::table('paket_umrahs')->insert([
                'id' => $paketUmrahId,
                'kode_paket' => $paketUmrahKode,
                'nama_paket' => fake()->sentence(3),
                'gambar' => fake()->imageUrl(),
                'deskripsi' => fake()->paragraph,
                'tanggal_keberangkatan' => fake()->date(),
                'tanggal_akhir_pendaftaran' => fake()->date(),
                'paket_tersedia' => fake()->randomElement(['Tersedia', 'Tidak Tersedia']),
                'total_hari' => fake()->numberBetween(5, 15),
                'pajak_bandara' => fake()->randomFloat(2, 100, 1000),
                'bus_bandara' => fake()->randomElement(['Included', 'Not Included']),
                'pembimbing' => $pembimbing->nama_depan . ' ' . $pembimbing->nama_belakang,
                'contact_person' => $pembimbing->no_hp,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $paketUmrahDetail = new PaketUmrahDetailSeeder($paketUmrahId, $paketUmrahKode);
            $paketUmrahDetail->run();

        }
            $golonganDarah = new GolonganDarahSeeder();
            $golonganDarah->run();

            $golonganDarah = new GolonganDarahSeeder();
            $golonganDarah->run();

            $jenisKelamin = new JenisKelaminSeeder();
            $jenisKelamin->run();

            $statusPernikahan = new StatusPernikahanSeeder();
            $statusPernikahan->run();
    }
}
