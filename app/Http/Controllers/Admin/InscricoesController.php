<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AtletaXCampeonato;

class InscricoesController extends Controller
{
    public function index(){
        $inscricoes = AtletaXCampeonato::all();

        return view('admin.inscricoes.index', compact("inscricoes"));
    }

}
