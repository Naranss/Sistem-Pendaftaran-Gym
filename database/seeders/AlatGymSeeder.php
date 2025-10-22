<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlatGym;


class AlatGymSeeder extends Seeder
{
    public function run(): void
    {
        $alatgym = [
            ['nama_alat' => 'Smith Machine', 'Kondisi' => 'BAIK'],
            ['nama_alat' => 'Dumbble', 'Kondisi' => 'BAIK'],
            ['nama_alat' => 'Bench Press', 'Kondisi' => 'BAIK'],
            ['nama_alat' => 'Lat Pulldown', 'Kondisi' => 'BAIK'],
            ['nama_alat' => 'Incline Bench Press', 'Kondisi' => 'BAIK'],
        ];

        foreach ($alatgym as $row) {
            AlatGym::create($row);
        }
    }
}
