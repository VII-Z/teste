<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    protected $table = 'vendas';
    protected $fillable = [
        'nome_cliente',
        'email_cliente',
        'produto',
        'preco',
        'status',
    ];
}
