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

        $rows[] = [
            'nama' => 'BAYU',
            'email' => 'bayu@gmail.com',
            'password' => Hash::make('trainer234'),
            'no_telp' => '081230000001',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'TRAINER',
            'membership_end' => null,
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];

        $rows[] = [
            'nama' => 'LISA',
            'email' => 'lisa@gmail.com',
            'password' => Hash::make('trainer345'),
            'no_telp' => '081230000002',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'TRAINER',
            'membership_end' => null,
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];

        $rows[] = [
            'nama' => 'RIZKY',
            'email' => 'rizky@gmail.com',
            'password' => Hash::make('trainer456'),
            'no_telp' => '081230000003',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'TRAINER',
            'membership_end' => null,
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];

        $rows[] = [
            'nama' => 'SINTA',
            'email' => 'sinta@gmail.com',
            'password' => Hash::make('trainer567'),
            'no_telp' => '081230000004',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'TRAINER',
            'membership_end' => null,
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];

        $rows[] = [
            'nama' => 'ILHAM',
            'email' => 'ilham@gmail.com',
            'password' => Hash::make('trainer678'),
            'no_telp' => '081230000005',
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

        $rows[] = [
            'nama' => 'RINA',
            'email' => 'rina@gmail.com',
            'password' => Hash::make('member234'),
            'no_telp' => '081250000001',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'MEMBER',
            'membership_end' => $now->copy()->addMonth()->toDateTimeString(),
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];
        $rows[] = [
            'nama' => 'FAJAR',
            'email' => 'fajar@gmail.com',
            'password' => Hash::make('member345'),
            'no_telp' => '081250000002',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'MEMBER',
            'membership_end' => $now->copy()->addMonth()->toDateTimeString(),
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];
        $rows[] = [
            'nama' => 'WULAN',
            'email' => 'wulan@gmail.com',
            'password' => Hash::make('member456'),
            'no_telp' => '081250000003',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'MEMBER',
            'membership_end' => $now->copy()->addMonth()->toDateTimeString(),
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];
        $rows[] = [
            'nama' => 'BAGUS',
            'email' => 'bagus@gmail.com',
            'password' => Hash::make('member567'),
            'no_telp' => '081250000004',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'MEMBER',
            'membership_end' => $now->copy()->addMonth()->toDateTimeString(),
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];
        $rows[] = [
            'nama' => 'TIKA',
            'email' => 'tika@gmail.com',
            'password' => Hash::make('member678'),
            'no_telp' => '081250000005',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'MEMBER',
            'membership_end' => $now->copy()->addMonth()->toDateTimeString(),
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];
        $rows[] = [
            'nama' => 'RIO',
            'email' => 'rio@gmail.com',
            'password' => Hash::make('member789'),
            'no_telp' => '081250000006',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'MEMBER',
            'membership_end' => $now->copy()->addMonth()->toDateTimeString(),
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];
        $rows[] = [
            'nama' => 'SANTI',
            'email' => 'santi@gmail.com',
            'password' => Hash::make('member890'),
            'no_telp' => '081250000007',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'MEMBER',
            'membership_end' => $now->copy()->addMonth()->toDateTimeString(),
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];
        $rows[] = [
            'nama' => 'AGUNG',
            'email' => 'agung@gmail.com',
            'password' => Hash::make('member901'),
            'no_telp' => '081250000008',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'MEMBER',
            'membership_end' => $now->copy()->addMonth()->toDateTimeString(),
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];
        $rows[] = [
            'nama' => 'JENNY',
            'email' => 'jenny@gmail.com',
            'password' => Hash::make('member012'),
            'no_telp' => '081250000009',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'MEMBER',
            'membership_end' => $now->copy()->addMonth()->toDateTimeString(),
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];
        $rows[] = [
            'nama' => 'DONI',
            'email' => 'doni@gmail.com',
            'password' => Hash::make('member111'),
            'no_telp' => '081250000010',
            'jenis_kelamin' => 'LAKI-LAKI',
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

        $rows[] = [
            'nama' => 'NIA',
            'email' => 'nia@gmail.com',
            'password' => Hash::make('pengunjung234'),
            'no_telp' => '081260000001',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'PENGUNJUNG',
            'membership_end' => null,
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];
        $rows[] = [
            'nama' => 'YOGA',
            'email' => 'yoga@gmail.com',
            'password' => Hash::make('pengunjung345'),
            'no_telp' => '081260000002',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'PENGUNJUNG',
            'membership_end' => null,
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];
        $rows[] = [
            'nama' => 'SARI',
            'email' => 'sari@gmail.com',
            'password' => Hash::make('pengunjung456'),
            'no_telp' => '081260000003',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'PENGUNJUNG',
            'membership_end' => null,
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];
        $rows[] = [
            'nama' => 'BUDI',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('pengunjung567'),
            'no_telp' => '081260000004',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'PENGUNJUNG',
            'membership_end' => null,
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];
        $rows[] = [
            'nama' => 'LALA',
            'email' => 'lala@gmail.com',
            'password' => Hash::make('pengunjung678'),
            'no_telp' => '081260000005',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'PENGUNJUNG',
            'membership_end' => null,
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];
        $rows[] = [
            'nama' => 'DEDI',
            'email' => 'dedi@gmail.com',
            'password' => Hash::make('pengunjung789'),
            'no_telp' => '081260000006',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'PENGUNJUNG',
            'membership_end' => null,
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];
        $rows[] = [
            'nama' => 'ZAHRA',
            'email' => 'zahra@gmail.com',
            'password' => Hash::make('pengunjung890'),
            'no_telp' => '081260000007',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'PENGUNJUNG',
            'membership_end' => null,
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];
        $rows[] = [
            'nama' => 'FARHAN',
            'email' => 'farhan@gmail.com',
            'password' => Hash::make('pengunjung901'),
            'no_telp' => '081260000008',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'PENGUNJUNG',
            'membership_end' => null,
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];
        $rows[] = [
            'nama' => 'MEGA',
            'email' => 'mega@gmail.com',
            'password' => Hash::make('pengunjung012'),
            'no_telp' => '081260000009',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'PENGUNJUNG',
            'membership_end' => null,
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];
        $rows[] = [
            'nama' => 'ARDI',
            'email' => 'ardi@gmail.com',
            'password' => Hash::make('pengunjung111'),
            'no_telp' => '081260000010',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'PENGUNJUNG',
            'membership_end' => null,
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ];

        DB::table('akun')->insert($rows);
    }
}
