<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Auditoria extends Model
{
    use HasFactory;

    protected $table = 'auditorias';

    protected $fillable = [
        'user_id',
        'tipo_acao',
        'detalhes',
        'data_hora',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'data_hora' => 'datetime',
    ];

    /**
     * Relacionamento com o usuário
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Método estático para registrar uma ação
     */
    public static function registrar($tipoAcao, $detalhes)
    {
        return self::create([
            'user_id' => auth()->id(),
            'tipo_acao' => $tipoAcao,
            'detalhes' => $detalhes,
            'data_hora' => now(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
    }
}
