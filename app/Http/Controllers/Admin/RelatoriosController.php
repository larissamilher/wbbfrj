<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campeonato;
use App\Models\AtletaXCampeonato;
use App\Models\Categoria;
use App\Models\Atleta;
use PhpOffice\PhpSpreadsheet\Exception;
use App\Models\Evento;

class RelatoriosController extends Controller
{
    public function index(){

        $campeonatos = Campeonato::orderBy('nome')->get();
        $eventos = Evento::orderBy('nome')->get();

        return view('admin.relatorios.index', compact('campeonatos','eventos'));
    }
}
