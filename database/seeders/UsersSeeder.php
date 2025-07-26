<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Hashing\BcryptHasher;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'firstname'=>'Rafael',
            'lastname' => 'Almeida',
            'email'=>'rafael@gmail.com',
            'password'=>Bcrypt('123456')
        ]);
    }
}
