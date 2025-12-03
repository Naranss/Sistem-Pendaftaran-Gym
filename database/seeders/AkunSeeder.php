<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AkunSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $rows = [];

        // ADMIN
        $rows[] = [
            'nama' => 'MBAH SINGO',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'no_telp' => '081234567890',
            'profile_photo_path' => 'assets/profilPhoto/foto1.jpeg',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'ADMIN',
            'membership_end' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'COKI',
            'email' => 'coki@gmail.com',
            'password' => Hash::make('admin234'),
            'no_telp' => '081200000001',
            'profile_photo_path' => 'assets/profilPhoto/foto2.jpeg',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'ADMIN',
            'membership_end' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'KRESNO',
            'email' => 'kresno@gmail.com',
            'password' => Hash::make('admin345'),
            'no_telp' => '081200000002',
            'profile_photo_path' => 'assets/profilPhoto/foto3.jpeg',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'ADMIN',
            'membership_end' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'ROCKY',
            'email' => 'rocky@gmail.com',
            'password' => Hash::make('admin456'),
            'no_telp' => '081200000003',
            'profile_photo_path' => 'assets/profilPhoto/foto4.jpeg',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'ADMIN',
            'membership_end' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'SISKO',
            'email' => 'sisko@gmail.com',
            'password' => Hash::make('admin567'),
            'no_telp' => '081200000004',
            'profile_photo_path' => 'assets/profilPhoto/foto5.jpeg',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'ADMIN',
            'membership_end' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];


        // TRAINER
        $rows[] = [
            'nama' => 'KRISWINAR',
            'email' => 'trainer@gmail.com',
            'password' => Hash::make('trainer123'),
            'no_telp' => '123876548901',
            'profile_photo_path' => 'assets/profilPhoto/iusgans.jpg',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'TRAINER',
            'membership_end' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'BAYU',
            'email' => 'bayu@gmail.com',
            'password' => Hash::make('trainer234'),
            'no_telp' => '081230000001',
            'profile_photo_path' => 'assets/profilPhoto/foto6.jpg',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'TRAINER',
            'membership_end' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'LISA',
            'email' => 'lisa@gmail.com',
            'password' => Hash::make('trainer345'),
            'no_telp' => '081230000002',
            'profile_photo_path' => 'assets/profilPhoto/foto03.jpg',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'TRAINER',
            'membership_end' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'RIZKY',
            'email' => 'rizky@gmail.com',
            'password' => Hash::make('trainer456'),
            'no_telp' => '081230000003',
            'profile_photo_path' => 'assets/profilPhoto/foto7.jpg',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'TRAINER',
            'membership_end' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'SINTA',
            'email' => 'sinta@gmail.com',
            'password' => Hash::make('trainer567'),
            'no_telp' => '081230000004',
            'profile_photo_path' => 'assets/profilPhoto/foto04.jpg',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'TRAINER',
            'membership_end' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'ILHAM',
            'email' => 'ilham@gmail.com',
            'password' => Hash::make('trainer678'),
            'no_telp' => '081230000005',
            'profile_photo_path' => 'assets/profilPhoto/foto8.jpg',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'TRAINER',
            'membership_end' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];


        // MEMBER (1 Bulan)
        $rows[] = [
            'nama' => 'SISKAE',
            'email' => 'member@gmail.com',
            'password' => Hash::make('member123'),
            'no_telp' => '123451678912',
            'profile_photo_path' => 'assets/profilPhoto/siskae01.jpeg',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'MEMBER',
            'membership_end' => $now->copy()->addMonth(),
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'RINA',
            'email' => 'rina@gmail.com',
            'password' => Hash::make('member234'),
            'no_telp' => '081250000001',
            'profile_photo_path' => 'assets/profilPhoto/foto05.jpeg',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'MEMBER',
            'membership_end' => $now->copy()->addMonth(),
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'FAJAR',
            'email' => 'fajar@gmail.com',
            'password' => Hash::make('member345'),
            'no_telp' => '081250000002',
            'profile_photo_path' => 'assets/profilPhoto/foto9.jpeg',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'MEMBER',
            'membership_end' => $now->copy()->addMonth(),
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'WULAN',
            'email' => 'wulan@gmail.com',
            'password' => Hash::make('member456'),
            'no_telp' => '081250000003',
            'profile_photo_path' => 'assets/profilPhoto/foto06.jpeg',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'MEMBER',
            'membership_end' => $now->copy()->addMonth(),
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'BAGUS',
            'email' => 'bagus@gmail.com',
            'password' => Hash::make('member567'),
            'no_telp' => '081250000004',
            'profile_photo_path' => 'assets/profilPhoto/foto10.jpeg',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'MEMBER',
            'membership_end' => $now->copy()->addMonth(),
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'TIKA',
            'email' => 'tika@gmail.com',
            'password' => Hash::make('member678'),
            'no_telp' => '081250000005',
            'profile_photo_path' => 'assets/profilPhoto/foto07.jpeg',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'MEMBER',
            'membership_end' => $now->copy()->addMonth(),
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'RIO',
            'email' => 'rio@gmail.com',
            'password' => Hash::make('member789'),
            'no_telp' => '081250000006',
            'profile_photo_path' => 'assets/profilPhoto/foto11.jpeg',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'MEMBER',
            'membership_end' => $now->copy()->addMonth(),
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'SANTI',
            'email' => 'santi@gmail.com',
            'password' => Hash::make('member890'),
            'no_telp' => '081250000007',
            'profile_photo_path' => 'assets/profilPhoto/foto08.jpeg',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'MEMBER',
            'membership_end' => $now->copy()->addMonth(),
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'AGUNG',
            'email' => 'agung@gmail.com',
            'password' => Hash::make('member901'),
            'no_telp' => '081250000008',
            'profile_photo_path' => 'assets/profilPhoto/foto12.jpeg',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'MEMBER',
            'membership_end' => $now->copy()->addMonth(),
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'JENNY',
            'email' => 'jenny@gmail.com',
            'password' => Hash::make('member012'),
            'no_telp' => '081250000009',
            'profile_photo_path' => 'assets/profilPhoto/foto09.jpeg',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'MEMBER',
            'membership_end' => $now->copy()->addMonth(),
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'DONI',
            'email' => 'doni@gmail.com',
            'password' => Hash::make('member111'),
            'no_telp' => '081250000010',
            'profile_photo_path' => 'assets/profilPhoto/foto13.jpeg',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'MEMBER',
            'membership_end' => $now->copy()->addMonth(),
            'created_at' => $now,
            'updated_at' => $now,
        ];


        // PENGUNJUNG
        $rows[] = [
            'nama' => 'MSBREWW',
            'email' => 'pengunjung@gmail.com',
            'password' => Hash::make('pengunjung123'),
            'no_telp' => '0123489653012',
            'profile_photo_path' => 'assets/profilPhoto/msbrew02.jpeg',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'PENGUNJUNG',
            'membership_end' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'NIA',
            'email' => 'nia@gmail.com',
            'password' => Hash::make('pengunjung234'),
            'no_telp' => '081260000001',
            'profile_photo_path' => 'assets/profilPhoto/foto010.jpeg',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'PENGUNJUNG',
            'membership_end' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'YOGA',
            'email' => 'yoga@gmail.com',
            'password' => Hash::make('pengunjung345'),
            'no_telp' => '081260000002',
            'profile_photo_path' => 'assets/profilPhoto/foto14.jpeg',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'PENGUNJUNG',
            'membership_end' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'SARI',
            'email' => 'sari@gmail.com',
            'password' => Hash::make('pengunjung456'),
            'no_telp' => '081260000003',
            'profile_photo_path' => 'assets/profilPhoto/foto011.jpeg',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'PENGUNJUNG',
            'membership_end' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'BUDI',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('pengunjung567'),
            'no_telp' => '081260000004',
            'profile_photo_path' => 'assets/profilPhoto/foto15.jpeg',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'PENGUNJUNG',
            'membership_end' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'LALA',
            'email' => 'lala@gmail.com',
            'password' => Hash::make('pengunjung678'),
            'no_telp' => '081260000005',
            'profile_photo_path' => 'assets/profilPhoto/foto012.jpeg',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'PENGUNJUNG',
            'membership_end' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'DEDI',
            'email' => 'dedi@gmail.com',
            'password' => Hash::make('pengunjung789'),
            'no_telp' => '081260000006',
            'profile_photo_path' => 'assets/profilPhoto/foto16.jpeg',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'PENGUNJUNG',
            'membership_end' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'ZAHRA',
            'email' => 'zahra@gmail.com',
            'password' => Hash::make('pengunjung890'),
            'no_telp' => '081260000007',
            'profile_photo_path' => 'assets/profilPhoto/foto013.jpeg',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'PENGUNJUNG',
            'membership_end' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'FARHAN',
            'email' => 'farhan@gmail.com',
            'password' => Hash::make('pengunjung901'),
            'no_telp' => '081260000008',
            'profile_photo_path' => 'assets/profilPhoto/foto17.jpeg',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'PENGUNJUNG',
            'membership_end' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'MEGA',
            'email' => 'mega@gmail.com',
            'password' => Hash::make('pengunjung012'),
            'no_telp' => '081260000009',
            'profile_photo_path' => 'assets/profilPhoto/foto014.jpeg',
            'jenis_kelamin' => 'PEREMPUAN',
            'role' => 'PENGUNJUNG',
            'membership_end' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $rows[] = [
            'nama' => 'ARDI',
            'email' => 'ardi@gmail.com',
            'password' => Hash::make('pengunjung111'),
            'no_telp' => '081260000010',
            'profile_photo_path' => 'assets/profilPhoto/foto18.jpeg',
            'jenis_kelamin' => 'LAKI-LAKI',
            'role' => 'PENGUNJUNG',
            'membership_end' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];


        DB::table('akun')->insert($rows);
    }
}
