<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Executa o seeder para popular a tabela de produtos.
     */
    public function run(): void
    {
        // Instancia o Faker para gerar dados fictícios
        $faker = Faker::create();

        // Gera 20 produtos fictícios
        for ($i = 0; $i < 20; $i++) {
            Product::create([
                'nome' => $faker->word(),
                'descricao' => $faker->sentence(),
                'preco' => $faker->randomFloat(2, 10, 1000), // Gera um preço entre 10 e 1000
                'quantidade_em_estoque' => $faker->numberBetween(0, 100), // Gera uma quantidade entre 0 e 100
                'status' => $faker->boolean() // Gera true ou false para o status
            ]);
        }
    }
}
