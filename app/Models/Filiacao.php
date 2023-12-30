<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiacao extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
   
    protected $table = 'filiacao';
 
    protected $fillable = [
        'nome',
        'data_inicio_inscricao',
        'data_final_inscricao',
        'validade',
        'valor',
    ];

    public function atleta()
    {
        return $this->belongsTo(Atleta::class);
    }
}
