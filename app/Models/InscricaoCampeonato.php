<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use DB;
use Reliese\Database\Eloquent\Model as Eloquent;
use App\Models\Campeonato;
use App\Models\Categoria;

class InscricaoCampeonato extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
   
    protected $table = 'inscricoes_campeonato';
 
    protected $fillable = [
        'campeonanometo_id',
        'categoria_id',
        'cupom_id',
        'status',
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
        'endereco',
    ];

    public function campeonato()
    {
        return $this->belongsTo(Campeonato::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
