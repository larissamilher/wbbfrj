<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use DB;
use Reliese\Database\Eloquent\Model as Eloquent;
use App\Models\Campeonato;
use App\Models\SubCategoria;

class SubCategoriaCampeonato extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
   
    protected $table = 'sub_categorias_campeonato';
 
    protected $fillable = [
        'campeonato_id',
        'sub_categoria_id'
    ];

    public function campeonato()
    {
        return $this->belongsTo(Campeonato::class);
    }

    public function categoria()
    {
        return $this->belongsTo(SubCategoria::class);
    }
}
