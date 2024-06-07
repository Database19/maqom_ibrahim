<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusPernikahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusPernikahan = ['Menikah', 'Belum Menikah', 'Duda', 'Janda'];

        foreach ($statusPernikahan as $sp) {
            DB::table('status_pernikahans')->insert([
                'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'status_pernikahan' => $sp,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
