<?php

namespace Database\Seeders;

use App\Models\Lokasi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $lokasis = [
            [
                'nama_lokasi' => 'Stadion Utama',
            ],
            [
                'nama_lokasi' => 'Galeri Seni Kota',
            ],
            [
                'nama_lokasi' => 'Taman Kota',
            ],
           
        ];

        foreach ($lokasis as $lokasi) {
            Lokasi::create($lokasi);
        }
    }
}