<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
   
    protected $table = 'eventos';
 
     protected $fillable = [
         'nome',
         'data_inicio_inscricao',
         'data_final_inscricao',
         'data_evento',
         'valor',
         'local',
         'descricao'
     ];
}
