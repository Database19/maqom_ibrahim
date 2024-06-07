<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jabatan = ['Admin', 'Karyawan', 'Pimpinan', 'Pengurus', 'Pengawas','Pembimbing','Muthawif','Petugas'];

        foreach ($jabatan as $jbt) {
            DB::table('jabatans')->insert([
                'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'nama_jabatan' => $jbt,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
