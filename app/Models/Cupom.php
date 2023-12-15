<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use DB;
use Reliese\Database\Eloquent\Model as Eloquent;

class Cupom extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
   
    protected $table = 'cupons';
 
    protected $fillable = [
        'campeonanometo_id',
        'data_inicial',
        'data_final',
        'unico',
        'valor',
    ];
}
