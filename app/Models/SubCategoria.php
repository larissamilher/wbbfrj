<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use DB;
use Reliese\Database\Eloquent\Model as Eloquent;

class SubCategoria extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
   
    protected $table = 'sub_categorias';
 
     protected $fillable = [
         'nome',
         'categoria_id',
         'ativa'
     ];
    
}
