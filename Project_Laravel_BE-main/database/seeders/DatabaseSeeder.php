<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\AlatModel;
use App\Models\KategoriModel;
use App\Models\PelangganModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Admin::factory()->create([
            'admin_username' => 'fadhli',
            'password' => Hash::make('fadhli'),
        ]);
        
        KategoriModel::factory()->create([
            'kategori_nama' => 'Laptop',
        ]);
        PelangganModel::factory()->create([
            'pelanggan_nama'=>'Fadhli',
            'pelanggan_alamat'=>'Madyopuro',
            'pelanggan_notelp'=>'083146270144',
            'pelanggan_email'=>'fadhlishabri@gmail.com',
        ]);
        AlatModel::factory()->create([
            'alat_nama' => 'Asus',
            'alat_kategori_id' => 1,
            'alat_deskripsi' => 'Laptop',
            'alat_hargaperhari' => 1000,
            'alat_stok' => 10
        ]);
    }
}
