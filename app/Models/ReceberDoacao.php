<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceberDoacao extends Model
{
    protected $fillable = [
        'doador_id',
        'campanha_id',
        'observacoes',
    ];

    /**
     * Doação pertence a um doador
     */
    public function doador()
    {
        return $this->belongsTo(\App\Models\Doador::class);
    }

    /**
     * Doação pode ter muitos itens
     */
    public function itens()
    {
        return $this->hasMany(\App\Models\ReceberDoacaoItem::class);
    }

    /**
     * Doação pode pertencer a uma campanha
     */
    public function campanha()
    {
        return $this->belongsTo(\App\Models\TipoCampanha::class, 'campanha_id');
    }
}
