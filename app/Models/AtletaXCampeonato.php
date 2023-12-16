<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use DB;
use Reliese\Database\Eloquent\Model as Eloquent;
use App\Models\Campeonato;
use App\Models\Categoria;

class AtletaXCampeonato extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
   
    protected $table = 'atleta_x_campeonato';
 
    protected $fillable = [
        'campeonanometo_id',
        'categoria_id',
        'atleta_id',
        'cupom_id',
        'status_pagamento',
        'payment_id',
        'customer',
        'billingType',
        'value',
        'dueDate',
        'installmentCount',
        'totalValue',
        'remoteIp',
        'holderName',
        'number',
        'creditCard',
        'creditCardHolderInfo'
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
