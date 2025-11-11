<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $now = Carbon::now();

        $rows = [];

        // Admin
        $rows[] = [
            'nama' => 'MBAH SINGO',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'no_telp' => '081234567890',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'ADMIN',
            'membership_end' => null,
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];

        $rows[] = [
            'nama' => 'COKI',
            'email' => 'coki@gmail.com',
            'password' => Hash::make('admin234'),
            'no_telp' => '081200000001',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'ADMIN',
            'membership_end' => null,
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];

        $rows[] = [
            'nama' => 'KRESNO',
            'email' => 'kresno@gmail.com',
            'password' => Hash::make('admin345'),
            'no_telp' => '081200000002',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'ADMIN',
            'membership_end' => null,
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];

        $rows[] = [
            'nama' => 'ROCKY',
            'email' => 'rocky@gmail.com',
            'password' => Hash::make('admin456'),
            'no_telp' => '081200000003',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'ADMIN',
            'membership_end' => null,
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];

        $rows[] = [
            'nama' => 'SISKO',
            'email' => 'sisko@gmail.com',
            'password' => Hash::make('admin567'),
            'no_telp' => '081200000004',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'ADMIN',
            'membership_end' => null,
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];

        // Trainer
        $rows[] = [
            'nama' => 'COKI',
            'email' => 'trainer@gmail.com',
            'password' => Hash::make('trainer123'),
            'no_telp' => '123876548901',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'TRAINER',
            'membership_end' => null,
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];

        // Member (1 bulan)
        $rows[] = [
            'nama' => 'SISKAE',
            'email' => 'member@gmail.com',
            'password' => Hash::make('member123'),
            'no_telp' => '123451678912',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'MEMBER',
            'membership_end' => $now->copy()->addMonth()->toDateTimeString(),
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];

        // Pengunjung
        $rows[] = [
            'nama' => 'MSBREWW',
            'email' => 'pengunjung@gmail.com',
            'password' => Hash::make('pengunjung123'),
            'no_telp' => '0123489653012',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'PENGUNJUNG',
            'membership_end' => null,
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];

        DB::table('akun')->insert($rows);
    }
}
