<?php

namespace Database\Seeders;

use App\Models\MembershipPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembershipPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $plans = [
            [
                'nama_paket_id' => 'Paket Bulanan',
                'nama_paket_en' => 'Monthly Plan',
                'deskripsi_id' => '"Akses ke semua peralatan", "Akses loker"',
                'deskripsi_en' => '"Access to all equipment", "Locker access"',
                'durasi' => 1,
                'harga' => 300000,
            ],
            [
                'nama_paket_id' => 'Paket 3 Bulan',
                'nama_paket_en' => '3 Months Plan',
                'deskripsi_id' => '"Semua fitur paket bulanan", "Prioritas dukungan"',
                'deskripsi_en' => '"All monthly plan features", "Priority support"',
                'durasi' => 3,
                'harga' => 800000,
            ],

            [
                'nama_paket_id' => 'Paket Tahunan',
                'nama_paket_en' => 'Yearly Plan',
                'deskripsi_id' => '"Semua fitur paket sebelumnya", "Hemat Rp 600.000"',
                'deskripsi_en' => '"All previous plan features", "Save IDR 600.000"',
                'durasi' => 12,
                'harga' => 3000000,
            ],
        ];

        foreach ($plans as $plan) {
            MembershipPlan::create($plan);
        }
    }
}
