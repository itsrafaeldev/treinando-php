<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //Obs.: Os seeders comentados já foram executados
        $this->call([
            UsersSeeder::class,
            CategoriasSeeder::class,
            ProdutosSeeder::class
        ]);
    }
}
