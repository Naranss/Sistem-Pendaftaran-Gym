<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Suplemen;
use App\Models\GambarSuplemen;
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
                'gambar' => 'Protein Whey.jpg',
            ],
            [
                'nama_suplemen' => 'Creatine',
                'deskripsi_suplemen' => 'Meningkatkan kekuatan dan tenaga',
                'tanggal_kadaluarsa' => Carbon::now()->addYears(2),
                'harga' => 150000,
                'stok' => 30,
                'gambar' => 'creatine.jpg',
            ],
            [
                'nama_suplemen' => 'BCAA',
                'deskripsi_suplemen' => 'Digunakan untuk pemulihan otot',
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(18),
                'harga' => 200000,
                'stok' => 40,
                'gambar' => 'BCAA.jpg',
            ],
            [
                'nama_suplemen' => 'Optimum Nutrition Gold Standard Whey',
                'deskripsi_suplemen' => 'Whey protein paling populer untuk membangun otot',
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(12),
                'harga' => 450000,
                'stok' => 40,
                'gambar' => 'Optimum Nutrition Gold Standard Whey.jpg',
            ],
            [
                'nama_suplemen' => 'Dymatize ISO 100',
                'deskripsi_suplemen' => 'Protein isolate premium cepat serap',
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(14),
                'harga' => 520000,
                'stok' => 35,
                'gambar' => 'Dymatize ISO 100.jpg',
            ],
            [
                'nama_suplemen' => 'MyProtein Impact Whey',
                'deskripsi_suplemen' => 'Whey protein dengan harga lebih terjangkau',
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(10),
                'harga' => 380000,
                'stok' => 50,
                'gambar' => 'MyProtein Impact Whey.jpg',
            ],
            [
                'nama_suplemen' => 'Rule One R1 Whey Blend',
                'deskripsi_suplemen' => 'Campuran whey berkualitas untuk pertumbuhan otot',
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(12),
                'harga' => 400000,
                'stok' => 45,
                'gambar' => 'Rule One R1 Whey Blend.jpg',
            ],
            [
                'nama_suplemen' => 'MuscleTech NitroTech Whey Gold',
                'deskripsi_suplemen' => 'Whey protein dengan tambahan enzim pencernaan',
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(13),
                'harga' => 430000,
                'stok' => 38,
                'gambar' => 'MuscleTech NitroTech Whey Gold.jpg',
            ],
            [
                'nama_suplemen' => 'BSN Syntha-6',
                'deskripsi_suplemen' => 'Protein blend rasa creamy cocok untuk shake',
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(11),
                'harga' => 410000,
                'stok' => 32,
                'gambar' => 'BSN Syntha-6.jpg',
            ],
            [
                'nama_suplemen' => 'Ultimate Nutrition Prostar Whey',
                'deskripsi_suplemen' => 'Suplemen whey terkenal dengan rasa yang enak',
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(12),
                'harga' => 360000,
                'stok' => 42,
                'gambar' => 'Ultimate Nutrition Prostar Whey.jpg',
            ],
            [
                'nama_suplemen' => 'Mutant Whey',
                'deskripsi_suplemen' => 'Protein untuk yang ingin massa otot lebih besar',
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(9),
                'harga' => 390000,
                'stok' => 28,
                'gambar' => 'Mutant Whey.jpg',
            ],
            [
                'nama_suplemen' => 'MusclePharm Combat Protein',
                'deskripsi_suplemen' => 'Protein multi-release cocok sebelum dan sesudah latihan',
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(15),
                'harga' => 420000,
                'stok' => 33,
                'gambar' => 'MusclePharm Combat Protein.jpg',
            ],
            [
                'nama_suplemen' => 'Pro Jym Protein Blend',
                'deskripsi_suplemen' => 'Campuran whey-casein untuk pertumbuhan dan pemulihan otot',
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(16),
                'harga' => 500000,
                'stok' => 30,
                'gambar' => 'Pro Jym Protein Blend.jpg',
            ],

            [
                'nama_suplemen' => 'Cellucor C4 Original Pre-Workout',
                'deskripsi_suplemen' => 'Pre workout paling populer untuk energi dan fokus saat latihan',
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(8),
                'harga' => 320000,
                'stok' => 35,
                'gambar' => 'Cellucor C4 Original Pre-Workout.jpg',
            ],
            [
                'nama_suplemen' => 'Legion Pulse Pre-Workout',
                'deskripsi_suplemen' => 'Pre workout clean tanpa stimulan berlebih, fokus dan pump kuat',
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(10),
                'harga' => 450000,
                'stok' => 25,
                'gambar' => 'Legion Pulse Pre-Workout.jpg',
            ],
            [
                'nama_suplemen' => 'Pre Jym Pre-Workout',
                'deskripsi_suplemen' => 'Pre workout lengkap dengan BCAA & Citrulline untuk kekuatan latihan',
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(9),
                'harga' => 480000,
                'stok' => 20,
                'gambar' => 'Pre Jym Pre-Workout.png',
            ],
            [
                'nama_suplemen' => 'MuscleTech Platinum Creatine',
                'deskripsi_suplemen' => 'Creatine monohydrate murni untuk kenaikan tenaga dan massa otot',
                'tanggal_kadaluarsa' => Carbon::now()->addYears(2),
                'harga' => 180000,
                'stok' => 50,
                'gambar' => 'MuscleTech Platinum Creatine.jpg',
            ],
            [
                'nama_suplemen' => 'ON Micronized Creatine Powder',
                'deskripsi_suplemen' => 'Creatine micronized untuk penyerapan tenaga lebih cepat',
                'tanggal_kadaluarsa' => Carbon::now()->addYears(2),
                'harga' => 190000,
                'stok' => 45,
                'gambar' => 'ON Micronized Creatine Powder.jpg',
            ],
            [
                'nama_suplemen' => 'Lipo 6 Black',
                'deskripsi_suplemen' => 'Fat burner thermogenic kuat untuk pembakaran lemak',
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(14),
                'harga' => 300000,
                'stok' => 30,
                'gambar' => 'Lipo 6 Black.jpg',
            ],
            [
                'nama_suplemen' => 'Hydroxycut Hardcore Elite',
                'deskripsi_suplemen' => 'Meningkatkan metabolisme dan energi saat diet',
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(12),
                'harga' => 270000,
                'stok' => 28,
                'gambar' => 'Hydroxycut Hardcore Elite.jpg',
            ],
            [
                'nama_suplemen' => 'Animal Cuts',
                'deskripsi_suplemen' => 'Fat burner paket lengkap untuk definisi tubuh',
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(13),
                'harga' => 550000,
                'stok' => 18,
                'gambar' => 'Animal Cuts.jpg',
            ],
        ];

        foreach ($samples as $s) {

            // data suplemen
            $sup = Suplemen::create([
                'nama_suplemen' => $s['nama_suplemen'],
                'deskripsi_suplemen' => $s['deskripsi_suplemen'],
                'tanggal_kadaluarsa' => $s['tanggal_kadaluarsa'],
                'harga' => $s['harga'],
                'stok' => $s['stok'],
            ]);

            //  gambar suplemen 
            GambarSuplemen::create([
                'suplemen_id' => $sup->id,
                'path' => 'assets/suplemen/' . $s['gambar'],
                'img_alt' => $s['nama_suplemen']
            ]);
        }
    }
}
