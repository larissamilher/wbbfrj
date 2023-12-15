<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use DB;
use Reliese\Database\Eloquent\Model as Eloquent;

class Categoria extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
   
    protected $table = 'categorias';
 
     protected $fillable = [
         'nome',
         'genero',
         'ativa'
     ];
    
}
