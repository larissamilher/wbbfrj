<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campeonato;
use App\Models\AtletaXCampeonato;
use App\Models\Categoria;
use App\Models\Atleta;
use App\Models\InscricaoEvento;
use PhpOffice\PhpSpreadsheet\Exception;

class AdminController extends Controller
{
    public function index(){

        $atletasComIsncricao = Atleta::with('campeonatos')
            ->has('campeonatos') 
            ->orderBy('nome')->count();

        $atletasSemInscricao = Atleta::doesntHave('campeonatos')
            ->orderBy('nome')->count();

        $inscricoesEventosTotais = InscricaoEvento::with([
            'evento' => function ($query) {
                $query->withTrashed(); 
            },
        ])->count();

        $inscricoesEventosPagos = InscricaoEvento::with([
            'evento' => function ($query) {
                $query->withTrashed(); 
            },
        ])->whereIn('status_pagamento', ['CONFIRMED','RECEIVED'])->count();
        
        $inscricoesCampeonatosPagos = AtletaXCampeonato::whereIn('status_pagamento', ['CONFIRMED','RECEIVED'])->count();

        $retorno  =[
            'categorias' =>Categoria::count(),
            'campeonatos' =>Campeonato::count(),
            'atletasComIsncricao' =>$atletasComIsncricao ,
            'atletasSemInscricao' =>$atletasSemInscricao ,
            'inscricoesCampeonatosTotais' =>AtletaXCampeonato::count(),
            'inscricoesCampeonatosPagos' => $inscricoesCampeonatosPagos,
            'inscricoesEventosTotais' =>$inscricoesEventosTotais,
            'inscricoesEventosPagos' =>$inscricoesEventosPagos,
        ];


        return view('admin.dashboard', compact('retorno'));
    }
}
