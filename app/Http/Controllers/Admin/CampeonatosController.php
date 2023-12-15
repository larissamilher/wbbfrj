<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CampeonatosController extends Controller
{
    public function index(){
        
        $campeonatos = Campeonato::where('data_inicio_inscricao', '<=', now())
            ->where('data_final_inscricao', '>=', now())
            ->get();

        return view('site.inscricao', compact([ 'campeonatos' ]));
        
    }
}
