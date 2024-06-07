<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKelaminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisKelamin = ['Laki-Laki', 'Perempuan'];

        foreach ($jenisKelamin as $jk) {
            DB::table('jenis_kelamins')->insert([
                'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'jenis_kelamin' => $jk,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
