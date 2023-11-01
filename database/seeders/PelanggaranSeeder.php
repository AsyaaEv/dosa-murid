<?php

namespace Database\Seeders;

use App\Models\Pelanggaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelanggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pelanggaran::create([
            'kode_pelanggaran' => 'PLG001',
            'nama_pelanggaran' => 'Terlambat',
            'point' => '10',
        ]);
        Pelanggaran::create([
            'kode_pelanggaran' => 'PLG002',
            'nama_pelanggaran' => 'Tidak Membawa Dasi',
            'point' => '10',
        ]);
    }
}
