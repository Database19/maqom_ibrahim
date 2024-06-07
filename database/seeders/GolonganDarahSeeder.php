<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GolonganDarahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $golonganDarah = ['A', 'B', 'AB', 'O'];

        foreach ($golonganDarah as $gdr) {
            DB::table('golongan_darahs')->insert([
                'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'golongan_darah' => $gdr,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
