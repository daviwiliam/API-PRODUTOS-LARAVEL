<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductController extends Controller implements HasMiddleware
{
    // Define o middleware para autenticação via Sanctum
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum')
        ];
    }

    /**
     * Exibe uma listagem de todos os produtos.
     */
    public function index()
    {
        // Retorna todos os produtos cadastrados
        return Product::all();
    }

    /**
     * Armazena um novo produto no banco de dados.
     */
    public function store(Request $request)
    {
        // Valida os campos enviados na requisição
        $fields = $request->validate([
            'nome' => 'required|min:3',
            'descricao' => 'nullable|max:255',
            'preco' => 'required|numeric|min:0',
            'quantidade_em_estoque' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);

        // Cria um novo produto com os dados validados
        $product = Product::create($fields);

        // Retorna o produto criado
        return $product;
    }

    /**
     * Exibe um produto específico.
     */
    public function show(Product $product)
    {
        // Retorna o produto especificado
        return $product;
    }

    /**
     * Atualiza um produto existente no banco de dados.
     */
    public function update(Request $request, Product $product)
    {
        // Valida os campos enviados para atualização
        $fields = $request->validate([
            'nome' => 'required|min:3',
            'descricao' => 'nullable|max:255',
            'preco' => 'required|numeric|min:0',
            'quantidade_em_estoque' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);

        // Atualiza o produto com os dados validados
        $product->update($fields);

        // Retorna o produto atualizado
        return $product;
    }

    /**
     * Remove um produto específico do banco de dados.
     */
    public function destroy(Product $product)
    {
        // Deleta o produto especificado
        $product->delete();

        // Retorna uma mensagem de sucesso
        return [
            'mensagem' => 'Produto deletado'
        ];
    }
}
