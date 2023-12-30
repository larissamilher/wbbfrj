<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use DB;
use Reliese\Database\Eloquent\Model as Eloquent;

class Atleta extends Model
{
   use \Illuminate\Database\Eloquent\SoftDeletes;
   
   protected $table = 'atletas';

    protected $fillable = [
        'nome',
        'cpf',
        'rg',
        'data_nascimento',
        'celular',
        'email',
        'status_pagamento',
        'cep',
        'estado',
        'cidade',
        'logradouro',
        'bairro',
        'numero',
        'academia_coach',
        'autorizacao_uso_imagem',
        'termos_atleta'
    ];


    public function campeonatos()
    {
        return $this->belongsToMany(Campeonato::class, 'atleta_x_campeonato');
    }
}
