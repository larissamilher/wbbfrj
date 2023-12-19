<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AtletaXCampeonato;
use App\Models\Campeonato;
use App\Exports\ListagemExport;
use Maatwebsite\Excel\Facades\Excel;

class InscricoesController extends Controller
{
    public function index()
    {
        $inscricoes = AtletaXCampeonato::with(['campeonato', 'categoria', 'atleta'])->get(); 

        return view('admin.inscricoes.index', compact("inscricoes"));
    }

    public function extrairListagemTela()
    {
        $campeonatos = Campeonato::all();

        return view('admin.inscricoes.extrair-listagem', compact("campeonatos"));
    }

    public function extrairListagem(Request $request)
    {
        $campeonatoId = $request->input('campeonato');

        $nomeCampeonato = Campeonato::find($campeonatoId);

        $export = new ListagemExport($campeonatoId);

        return Excel::download(new ListagemExport($campeonatoId), $nomeCampeonato->nome . '.xlsx');
    }

    public function detalhes($id){

        $inscricao = AtletaXCampeonato::with(['campeonato', 'categoria', 'atleta'])->find($id); 

        // dd($inscricao);

        return view('admin.inscricoes.detalhes', compact("inscricao"));
    }
}
