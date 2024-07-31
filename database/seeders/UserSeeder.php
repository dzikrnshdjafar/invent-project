<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Atmint',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('asdasdasd'),
        ]);

        User::create([
            'name' => 'Lola',
            'email' => 'pengelola@gmail.com',
            'password' => bcrypt('asdasdasd'),
        ]);

        User::create([
            'name' => 'Injam',
            'email' => 'peminjam@gmail.com',
            'password' => bcrypt('asdasdasd'),
        ]);

        User::create([
            'name' => 'Injam2',
            'email' => 'peminjam2@gmail.com',
            'password' => bcrypt('asdasdasd'),
        ]);
    }
}
