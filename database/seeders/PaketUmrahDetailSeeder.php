<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaketUmrahDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $paketUmrahId;
    protected $paketUmrahKode;

    public function __construct($paketUmrahId, $paketUmrahKode)
    {
        $this->paketUmrahId = $paketUmrahId;
        $this->paketUmrahKode = $paketUmrahKode;
    }

    public function run(): void
    {
        $paketUmrahId = $this->paketUmrahId;
        $paketUmrahKode = $this->paketUmrahKode;

        foreach (['Double', 'Triple', 'Quad'] as $jenisKamar) {
            DB::table('paket_umrah_details')->insert([
                'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'id_paket_umrah' => $paketUmrahId,
                'kode_paket' => $paketUmrahKode,
                'jenis_kamar' => $jenisKamar,
                'harga_paket' => fake()->numberBetween(1000, 5000),
                'hotel_mekkah' => fake()->word,
                'hotel_madinah' => fake()->word,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
