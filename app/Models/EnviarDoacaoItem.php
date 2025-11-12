<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnviarDoacaoItem extends Model
{
    protected $table = 'enviar_doacao_items';

    protected $fillable = [
        'enviar_doacao_id',
        'item_id',
        'quantidade',
        'validade',
        'tamanho_valor',
        'tamanho_unidade',
        'tamanho_texto',
        'condicao',
    ];

    protected $casts = [
        'validade' => 'date',
        'tamanho_valor' => 'decimal:2',
    ];

    public function doacao()
    {
        return $this->belongsTo(\App\Models\EnviarDoacao::class, 'enviar_doacao_id');
    }

    public function item()
    {
        return $this->belongsTo(\App\Models\Item::class);
    }
}
