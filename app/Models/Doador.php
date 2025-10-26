<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doador extends Model
{
    protected $fillable = [
        'tipo',
        'nome',
        'cpf',
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
