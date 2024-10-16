<?php

namespace Tests\Unit;

// tests/Unit/ProductControllerTest.php

use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Criar um usuário para autenticar
        $this->user = User::factory()->create();
    }

    public function test_can_list_products()
    {
        // Simular autenticação
        $this->actingAs($this->user, 'sanctum');

        $response = $this->get('/api/products');
        $response->assertStatus(200);
    }

    public function test_can_create_product()
    {
        // Simular autenticação
        $this->actingAs($this->user, 'sanctum');

        $data = [
            'nome' => 'Produto Teste',
            'descricao' => 'Descrição do produto teste',
            'preco' => 100,
            'quantidade_em_estoque' => 10,
            'status' => true,
        ];

        $response = $this->post('/api/products', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('products', ['nome' => 'Produto Teste']);
    }

    public function test_can_show_product()
    {
        // Simular autenticação
        $this->actingAs($this->user, 'sanctum');

        $product = Product::factory()->create();

        $response = $this->get('/api/products/' . $product->id);
        $response->assertStatus(200);
        $response->assertJson($product->toArray());
    }

    public function test_can_update_product()
    {
        // Simular autenticação
        $this->actingAs($this->user, 'sanctum');

        $product = Product::factory()->create();

        $data = [
            'nome' => 'Produto Atualizado',
            'descricao' => 'Descrição atualizada',
            'preco' => 150,
            'quantidade_em_estoque' => 5,
            'status' => true,
        ];

        $response = $this->put('/api/products/' . $product->id, $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('products', ['nome' => 'Produto Atualizado']);
    }

    public function test_can_delete_product()
    {
        // Simular autenticação
        $this->actingAs($this->user, 'sanctum');

        $product = Product::factory()->create();

        $response = $this->delete('/api/products/' . $product->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
