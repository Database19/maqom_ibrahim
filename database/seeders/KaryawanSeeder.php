<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 0; $i < 20; $i++) {
            $jabatan = DB::table('jabatans')->inRandomOrder()->first();

            DB::table('karyawans')->insert([
                'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'nama_depan' => fake()->firstName,
                'nama_belakang' => fake()->lastName,
                'jabatan' => $jabatan->nama_jabatan,
                'tempat_lahir' => fake()->city,
                'tanggal_lahir' => fake()->date,
                'jenis_kelamin' => fake()->randomElement(['Laki-Laki', 'Perempuan']),
                'alamat' => fake()->address,
                'no_hp' => fake()->phoneNumber,
                'email' => fake()->email,
                'status' => fake()->randomElement(['1', '0']),
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
