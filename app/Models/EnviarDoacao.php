<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnviarDoacao extends Model
{
    protected $fillable = [
        'instituicao_id',
        'campanha_id',
        'observacoes',
    ];

    /**
     * Envio pertence a uma instituição
     */
    public function instituicao()
    {
        return $this->belongsTo(\App\Models\Instituicao::class);
    }

    /**
     * Envio pode ter muitos itens
     */
    public function itens()
    {
        return $this->hasMany(\App\Models\EnviarDoacaoItem::class);
    }

    /**
     * Envio pode pertencer a uma campanha
     */
    public function campanha()
    {
        return $this->belongsTo(\App\Models\TipoCampanha::class, 'campanha_id');
    }
}
