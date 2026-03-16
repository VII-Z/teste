<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conteudo extends Model
{
    protected $table = 'conteudo';
    protected $fillable = ['titulo', 'subtitulo', 'descricao', 'imagem', 'preco'];
}
