<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Atleta;
use PhpOffice\PhpSpreadsheet\Exception;
use App\Models\AtletaXCampeonato;

class AtletasController extends Controller
{
    public function index(){

        $atletas = Atleta::orderBy('nome')->get();

        return view('admin.atletas.index', compact('atletas'));
    }


    public function detalhes($id){

        $atleta = Atleta::find($id);

        $inscricoes = AtletaXCampeonato::with([
            'categoria' => function ($query) {
                $query->withTrashed(); // Inclui registros "soft-deleted" no relacionamento 'categoria'
            },
            'campeonato' => function ($query) {
                $query->withTrashed(); // Inclui registros "soft-deleted" no relacionamento 'categoria'
            },
        ])->where("atleta_id", $atleta->id)->orderBy('created_at', 'desc')->get();

        return view('admin.atletas.detalhes', compact('atleta','inscricoes'));
    }
}
