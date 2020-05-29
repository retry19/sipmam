<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::insert([
            [
                'nama' => 'Hayasaka',
                'no_hp' => '+62083922',
                'role' => 'pelayan',
                'username' => 'pelayan',
                'password' => bcrypt('pelayan')
            ],
            [
                'nama' => 'Miyuki',
                'no_hp' => '+62082716',
                'role' => 'koki',
                'username' => 'koki',
                'password' => bcrypt('koki')
            ],
            [
                'nama' => 'Kaguya',
                'no_hp' => '+62272135',
                'role' => 'kasir',
                'username' => 'kasir',
                'password' => bcrypt('kasir')
            ],
            [
                'nama' => 'Chika',
                'no_hp' => '+6282963',
                'role' => 'owner',
                'username' => 'owner',
                'password' => bcrypt('owner')
            ],
        ]);
    }
}
