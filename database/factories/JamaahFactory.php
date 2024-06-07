<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // Add this line


use App\Models\JenisKelamin;
use App\Models\StatusPernikahan;
use App\Models\GolonganDarah;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jamaah>
 */
class JamaahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(), // Fix the issue by adding the correct import
            'no_ktp' => fake()->numerify('####################'),
            'nama_lengkap' => fake()->name,
            'jenis_kelamin' => function () {
                return JenisKelamin::inRandomOrder()->first()->jenis_kelamin; // Assuming 'jeniskelamin' is the column in JenisKelamin model
            },
            'status_pernikahan' => function () {
                return StatusPernikahan::inRandomOrder()->first()->status_pernikahan; // Assuming 'jeniskelamin' is the column in JenisKelamin model
            },
            'foto' => fake()->text,
            'nama_foto' => fake()->word . '.png',
            'tempat_lahir' => fake()->city . ', ' . fake()->state,
            'tanggal_lahir' => fake()->date,
            'usia' => fake()->numberBetween(20, 60),
            'kewarganegaraan' => 'Indonesia',
            'golongan_darah' => function () {
                return GolonganDarah::inRandomOrder()->first()->golongan_darah; // Assuming 'jeniskelamin' is the column in JenisKelamin model
            },
            'nama_relasi' => fake()->name,
            'role_relasi' => 'member',
            'alamat_lengkap' => fake()->address,
            'alamat_lengkap2' => fake()->address,
            'provinsi' => fake()->state,
            'kota' => fake()->city,
            'kecamatan' => fake()->city,
            'kelurahan' => fake()->city,
            'rw' => fake()->numerify('##'),
            'rt' => fake()->numerify('##'),
            'kodepos' => fake()->numerify('#####'),
            'no_telp' => fake()->phoneNumber,
            'email' => fake()->email,
            'nama_sekolah' => fake()->word,
            'alamat_sekolah' => fake()->address,
            'pendidikan' => fake()->word,
            'tempat_kerja' => fake()->company,
            'nama_bagian' => fake()->word,
            'profesi' => fake()->word,
            'members' => '',
            'is_deleted' => 0,
        ];
    }
}
