<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campeonato;
use App\Models\AtletaXCampeonato;
use App\Models\Categoria;
use App\Models\Atleta;


class AdminController extends Controller
{
    public function index(){

        $retorno  =[
            'categorias' =>Categoria::count(),
            'campeonatos' =>Campeonato::count(),
            'atletas' =>Atleta::count(),
            'inscricoes' =>AtletaXCampeonato::count(),
        ];

        return view('admin.dashboard', compact('retorno'));
    }
}
