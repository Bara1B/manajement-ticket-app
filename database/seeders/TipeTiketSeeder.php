<?php

namespace Database\Seeders;

use App\Models\TipeTiket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipeTiketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipeTikets = [
            [
                'nama' => 'Reguler',
                'keterangan' => 'Tiket dengan harga standar untuk akses normal ke acara',
            ],
            [
                'nama' => 'VIP',
                'keterangan' => 'Tiket premium dengan fasilitas khusus dan tempat duduk prioritas',
            ],
            [
                'nama' => 'Early Bird',
                'keterangan' => 'Tiket diskon untuk pembeli awal dengan jumlah terbatas',
            ],
            [
                'nama' => 'Student',
                'keterangan' => 'Tiket khusus untuk mahasiswa dengan harga spesial',
            ],
            [
                'nama' => 'Group',
                'keterangan' => 'Tiket untuk pembelian dalam jumlah besar dengan harga grosir',
            ],
        ];

        foreach ($tipeTikets as $tipeTiket) {
            TipeTiket::create($tipeTiket);
        }
    }
}
