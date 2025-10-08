<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlatGym;

class AlatGymSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $alatgym = [
            ['nama_alat' => 'Smith Machine', 'kondisi' => 'BAIK'],
            ['nama_alat' => 'Bench Press ', 'kondisi' => 'BAIK'],
            ['nama_alat' => 'Dumbbell Set 1-40kg', 'kondisi' => 'BAIK'],
            ['nama_alat' => 'Lat Pulldown', 'kondisi' => 'BAIK'],
            ['nama_alat' => 'Incline Bench Press', 'kondisi' => 'RUSAK'],
        ];

        foreach ($alatgym as $row) {
            AlatGym::create($row);
        }
    }
}
