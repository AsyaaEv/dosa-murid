<?php

namespace Database\Seeders;

use App\Models\GuruBK;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuruBKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GuruBK::create([
            'kode_bk' => 'BK001',
            'nama' => 'Syukurillah',
            'nip' => '1234567890',
            'alamat' => 'Jl. Raya Bangsri',
            'no_telepon' => '0858354112',
        ]);
        GuruBK::create([
            'kode_bk' => 'BK002',
            'nama' => 'Hariyati',
            'nip' => '0987654321',
            'alamat' => 'Jl. Raya Mlonggo',
            'no_telepon' => '089678456',
        ]);
    }
}
