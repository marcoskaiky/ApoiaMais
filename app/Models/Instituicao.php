<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    protected $fillable = [
        'nome',
        'cnpj',
        'telefone',
        'cep',
        'rua',
        'numero',
        'bairro',
        'cidade',
        'uf',
        'complemento',
    ];
}
