<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscricaoEvento extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
   
    protected $table = 'inscricoes_eventos';
 
    protected $fillable = [
        'evento_id',
        'convidado',
        'usado',
        'data_usado',
        'codigo',
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
        'creditCardNumber',
        'creditCardBrand',
        'creditCardToken',
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
