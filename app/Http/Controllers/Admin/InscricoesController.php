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
    public function index(){
        $inscricoes = AtletaXCampeonato::all();

        return view('admin.inscricoes.index', compact("inscricoes"));
    }

    public function extrairListagemTela()
    {
        $campeonatos = Campeonato::all();

        return view('admin.inscricoes.extrair-listagem', compact("campeonatos"));
    }

    public function extrairListagem($campeonatoId)
    {
        $nomeCampeonato = Campeonato::find($campeonatoId);

        $export = new ListagemExport($campeonatoId);

        $filePath = Excel::store($export, 'exports/' . $nomeCampeonato->nome . '.xlsx', 'local');

        // Implemente a lógica para redirecionar ou fazer o download do arquivo, conforme necessário
        return response()->download(storage_path('app/' . $filePath))->deleteFileAfterSend();

    }
}
