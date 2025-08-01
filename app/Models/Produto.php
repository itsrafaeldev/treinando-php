<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{User, Categoria};

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';
    protected $fillable = [
        'nome',
        'preco',
        'descricao',
        'imagem',
        'slug',
        'id_categoria',
        'id_user',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_user');
    }
}
