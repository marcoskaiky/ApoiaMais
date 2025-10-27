<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'categoria_id',
        'nome',
        'estoque_minimo',
        'validade',
        'condicao',
        'tamanho',
    ];

    protected $casts = [
        'validade' => 'boolean',
        'condicao' => 'boolean',
        'tamanho' => 'boolean',
    ];

    /**
     * Relacionamento com Categoria
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
