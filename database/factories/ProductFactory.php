<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->word,
            'descricao' => $this->faker->sentence,
            'preco' => $this->faker->randomFloat(2, 10, 1000),
            'quantidade_em_estoque' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->boolean,
        ];
    }
}

