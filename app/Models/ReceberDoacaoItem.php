<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceberDoacaoItem extends Model
{
    protected $table = 'receber_doacao_items';

    protected $fillable = [
        'receber_doacao_id',
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
        return $this->belongsTo(\App\Models\ReceberDoacao::class, 'receber_doacao_id');
    }

    public function item()
    {
        return $this->belongsTo(\App\Models\Item::class);
    }
}
