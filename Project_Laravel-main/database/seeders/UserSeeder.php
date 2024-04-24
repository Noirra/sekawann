<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Data_User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Data_User::insert([
            [
                'user_id' => '1',
                'user_fullname' => 'Administrator',
                'user_username' => 'admin',
                'user_password' => bcrypt('admin'),
                'user_email' => 'adminshop@gmail.com',
                'user_notelp' => '085804561414',
                'user_alamat' => 'Jln. Kepemimpinan, Kec. Siswa, Kel. Bawahan No. 15206',
                'user_level' => 'admin',
                'user_status' => true,
                'created_at' => '2023-08-01 23:00:00',
                'updated_at' => '2023-08-01 23:00:00',
            ],
            [
                'user_id' => '2',
                'user_fullname' => 'Pengguna',
                'user_username' => 'pengguna',
                'user_password' => bcrypt('pengguna'),
                'user_email' => 'penggunashop@gmail.com',
                'user_notelp' => '081332314613',
                'user_alamat' => 'Jln. Keanggotaan, Kec. Siswa, Kel. Bawahan No. 15206',
                'user_level' => 'pengguna',
                'user_status' => true,
                'created_at' => '2023-08-01 23:00:00',
                'updated_at' => '2023-08-01 23:00:00',
            ]
        ]);
    }
}