<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use DB;
use Reliese\Database\Eloquent\Model as Eloquent;

class Campeonato extends Model
{
   use \Illuminate\Database\Eloquent\SoftDeletes;
   
   protected $table = 'campeonatos';

    protected $fillable = [
        'nome',
        'data_inicio_inscricao',
        'data_final_inscricao',
        'data_campeonato',
        'valor',
        'valor_dobra',
        'local',
        'descricao'
    ];

}
