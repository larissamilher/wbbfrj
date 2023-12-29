<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiado extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
   
    protected $table = 'filiados';
 
    protected $fillable = [
        'codigo',
        'atleta_id',
        'status',
        'validade_filiacao',
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
        'creditCardNumber',
        'creditCardBrand',
        'creditCardToken',
    ];

    public function atleta()
    {
        return $this->belongsTo(Atleta::class);
    }
}
