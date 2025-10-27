<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoCampanha extends Model
{
    protected $fillable = [
        'nome',
        'meta',
    ];

    protected $casts = [
        'meta' => 'decimal:2',
    ];

    /**
     * Relacionamento com doações recebidas
     */
    public function doacoes()
    {
        return $this->hasMany(ReceberDoacao::class, 'campanha_id');
    }

    /**
     * Calcular o total arrecadado na campanha
     */
    public function getTotalArrecadadoAttribute()
    {
        return $this->doacoes()
            ->with('itens')
            ->get()
            ->sum(function($doacao) {
                return $doacao->itens->sum('quantidade');
            });
    }

    /**
     * Calcular a porcentagem da meta
     */
    public function getPorcentagemMetaAttribute()
    {
        if (!$this->meta || $this->meta == 0) {
            return 0;
        }

        $porcentagem = ($this->total_arrecadado / $this->meta) * 100;
        return min($porcentagem, 100); // Limita a 100%
    }
}
