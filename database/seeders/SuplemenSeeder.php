<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Suplemen;
use Carbon\Carbon;

class SuplemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Some fixed sample suplemen
        $samples = [
            [
                'nama_suplemen' => 'Protein Whey',
                'deskripsi_suplemen' => 'Suplemen protein untuk memenuhi kebutuhan protein',
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(12),
                'harga' => 250000,
                'stok' => 50,
            ],
            [
                'nama_suplemen' => 'Creatine',
                'deskripsi_suplemen' => 'Meningkatkan kekuatan dan tenaga',
                'tanggal_kadaluarsa' => Carbon::now()->addYears(2),
                'harga' => 150000,
                'stok' => 30,
            ],
            [
                'nama_suplemen' => 'BCAA',
                'deskripsi_suplemen' => 'Digunakan untuk pemulihan otot',
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(18),
                'harga' => 200000,
                'stok' => 40,
            ],
        ];

        foreach ($samples as $s) {
            Suplemen::create([
                'nama_suplemen' => $s['nama_suplemen'],
                'deskripsi_suplemen' => $s['deskripsi_suplemen'],
                'tanggal_kadaluarsa' => $s['tanggal_kadaluarsa'],
                'harga' => $s['harga'],
                'stok' => $s['stok'],
            ]);
        }
    }
}
