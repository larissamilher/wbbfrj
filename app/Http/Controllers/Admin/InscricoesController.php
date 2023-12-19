<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AtletaXCampeonato;
use App\Models\Campeonato;
use App\Exports\ListagemExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Support\Facades\View;

class InscricoesController extends Controller
{
    public function index()
    {
        $inscricoes = AtletaXCampeonato::with(['campeonato', 'categoria', 'atleta'])
        ->join('atletas', 'atletas.id', '=', 'atleta_x_campeonato.atleta_id')
        ->orderBy('atletas.nome') 
        ->select("atleta_x_campeonato.*")
        ->get();
    
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

    public function detalhes($id)
    {
        $inscricao = AtletaXCampeonato::with(['campeonato', 'categoria', 'atleta'])->find($id); 
        return view('admin.inscricoes.detalhes', compact("inscricao"));
    }

    public function gerarPdf($id){

        $inscricao = AtletaXCampeonato::with(['campeonato', 'categoria', 'atleta'])->find($id); 

        $pdfView = View::make('admin.inscricoes.detalhes-pdf',  ['inscricao' => $inscricao])->render();

        $pdf = PDF::loadHTML($pdfView);

        $nome = $inscricao->codigo;

        if(empty($nome))
            $nome = 'ficha-inscricao';

        return $pdf->download($nome.'.pdf');

    }


}
