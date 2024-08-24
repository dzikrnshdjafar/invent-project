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
            'no_hp' => '12333423434',
            'password' => bcrypt('asdasdasd'),
        ]);

        User::create([
            'name' => 'Lola',
            'email' => 'pengelola@gmail.com',
            'no_hp' => '1231334234',
            'password' => bcrypt('asdasdasd'),
        ]);

        User::create([
            'name' => 'Injam1',
            'email' => 'peminjam1@gmail.com',
            'no_hp' => '089502381584',
            'password' => bcrypt('asdasdasd'),
        ]);

        User::create([
            'name' => 'Injam2',
            'email' => 'peminjam2@gmail.com',
            'no_hp' => '082393521550',
            'password' => bcrypt('asdasdasd'),
        ]);

        User::create([
            'name' => 'Ndru',
            'email' => 'peminjam3@gmail.com',
            'no_hp' => '085244157231',
            'password' => bcrypt('asdasdasd'),
        ]);
    }
}
