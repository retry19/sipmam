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
                'foto_menu' => 'eWBejMkK1jIrvzTV.jpg',
                'jenis_menu' => 'makanan',
                'jml_tersedia' => 10,
                'harga' => 20000
            ],
            [
                'nama_menu' => 'Nasi Goreng Ayam Kampung',
                'foto_menu' => 'BXD6xE2eWrjQU9d5.jpg',
                'jenis_menu' => 'makanan',
                'jml_tersedia' => 12,
                'harga' => 15000
            ],
            [
                'nama_menu' => 'Mie Ayam',
                'foto_menu' => 'ora3JDIrm15tItlg.jpg',
                'jenis_menu' => 'makanan',
                'jml_tersedia' => 10,
                'harga' => 15000
            ],
            [
                'nama_menu' => 'Ice Milk with Boba Special',
                'foto_menu' => '8uZrBNCIs2ev1vj4.jpg',
                'jenis_menu' => 'minuman',
                'jml_tersedia' => 20,
                'harga' => 10000
            ],
            [
                'nama_menu' => 'Ice Coffee without Cafein',
                'foto_menu' => 'Z5dmzYIu35hOAdJD.jpg',
                'jenis_menu' => 'minuman',
                'jml_tersedia' => 32,
                'harga' => 12000
            ],
            [
                'nama_menu' => 'Ice Blue',
                'foto_menu' => 'ftn4od5bMjBfM6BY.jpg',
                'jenis_menu' => 'minuman',
                'jml_tersedia' => 16,
                'harga' => 9000
            ],
        ]);
    }
}
