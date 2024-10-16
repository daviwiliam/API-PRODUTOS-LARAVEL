<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'nome' => 'required|min:3',
            'descricao' => 'nullable|max:255',
            'preco' => 'required|numeric|min:0',
            'quantidade_em_estoque' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);

        $product = Product::create($fields);

        return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $fields = $request->validate([
            'nome' => 'required|min:3',
            'descricao' => 'nullable|max:255',
            'preco' => 'required|numeric|min:0',
            'quantidade_em_estoque' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);

        $product->update(($fields));

        return $product;
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return [
            'mensagem' => 'Produto deletado'
        ];
    }
}
