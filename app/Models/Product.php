<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id',
        'nome',
        'descricao',
        'preco',
        'quantidade_em_estoque',
        'status',
    ];    
}
