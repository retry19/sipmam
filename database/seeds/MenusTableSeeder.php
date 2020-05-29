<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Menu::insert([
            [
                'nama_menu' => 'Sate Ayam Spesial',
                'foto_menu' => 'makanan-1.jpg',
                'jenis_menu' => 'makanan',
                'jml_tersedia' => 10,
                'harga' => 20000
            ],
            [
                'nama_menu' => 'Nasi Goreng Ayam Kampung',
                'foto_menu' => 'makanan-2.jpeg',
                'jenis_menu' => 'makanan',
                'jml_tersedia' => 12,
                'harga' => 15000
            ],
            [
                'nama_menu' => 'Mie Ayam',
                'foto_menu' => 'makanan-3.jpeg',
                'jenis_menu' => 'makanan',
                'jml_tersedia' => 10,
                'harga' => 15000
            ],
            [
                'nama_menu' => 'Ice Milk with Boba Special',
                'foto_menu' => 'minuman-1.jpeg',
                'jenis_menu' => 'minuman',
                'jml_tersedia' => 20,
                'harga' => 10000
            ],
            [
                'nama_menu' => 'Ice Coffee without Cafein',
                'foto_menu' => 'minuman-2.jpeg',
                'jenis_menu' => 'minuman',
                'jml_tersedia' => 32,
                'harga' => 12000
            ],
            [
                'nama_menu' => 'Ice Blue',
                'foto_menu' => 'minuman-3.jpeg',
                'jenis_menu' => 'minuman',
                'jml_tersedia' => 16,
                'harga' => 9000
            ],
        ]);
    }
}
