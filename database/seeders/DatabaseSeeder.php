<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Executa os seeders.
     */
    public function run(): void
    {
        // Chama o seeder de produtos
        $this->call(ProductSeeder::class);
    }
}
