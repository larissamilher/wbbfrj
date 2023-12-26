<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AtletaXCampeonato;
use App\Models\Campeonato;
use App\Models\Categoria;
use App\Models\SubCategoria;
use App\Models\Atleta;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmacaoInscricao;
use Illuminate\Support\Facades\Log;
use App\Exports\ListagemExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Support\Facades\View;
use PhpOffice\PhpSpreadsheet\Exception;

class InscricoesController extends Controller
{
    public function index($campeonatoId = null, $codigo = null)
    {
        $inscricoes = AtletaXCampeonato::with([
            'campeonato' => function ($query) {
                $query->withTrashed(); // Inclui registros "soft-deleted" no relacionamento 'categoria'
            },
            'categoria' => function ($query) {
                $query->withTrashed(); // Inclui registros "soft-deleted" no relacionamento 'categoria'
            },
            'atleta'
        ])
        ->join('atletas', 'atletas.id', '=', 'atleta_x_campeonato.atleta_id')
        ->orderBy('atletas.nome') 
        ->select("atleta_x_campeonato.*");

        if($campeonatoId)
            $inscricoes = $inscricoes->where('atleta_x_campeonato.campeonato_id',$campeonatoId);

        if($codigo)
            $inscricoes = $inscricoes->where('atleta_x_campeonato.codigo', str_replace('-', '/', $codigo));

        $inscricoes = $inscricoes->get();

        $campeonatos = Campeonato::all();

        return view('admin.inscricoes.index', compact("inscricoes",'campeonatos'));
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
        $inscricao = AtletaXCampeonato::with([
            'campeonato' => function ($query) {
                $query->withTrashed(); // Inclui registros "soft-deleted" no relacionamento 'categoria'
            },
            'categoria' => function ($query) {
                $query->withTrashed(); // Inclui registros "soft-deleted" no relacionamento 'categoria'
            },
            'atleta'
        ])->find($id); 
        return view('admin.inscricoes.detalhes', compact("inscricao"));
    }

    public function gerarPdf($id){

        $inscricao = AtletaXCampeonato::with([
            'campeonato' => function ($query) {
                $query->withTrashed(); // Inclui registros "soft-deleted" no relacionamento 'categoria'
            },
            'categoria' => function ($query) {
                $query->withTrashed(); // Inclui registros "soft-deleted" no relacionamento 'categoria'
            },
            'atleta'
        ])->find($id); 

        $pdfView = View::make('admin.inscricoes.detalhes-pdf',  ['inscricao' => $inscricao])->render();

        $pdf = PDF::loadHTML($pdfView);

        $nome = $inscricao->codigo;

        if(empty($nome))
            $nome = 'ficha-inscricao';

        return $pdf->download($nome.'.pdf');

    }

    public function addPeso($id)
    {
        $inscricao = AtletaXCampeonato::with([
            'campeonato' => function ($query) {
                $query->withTrashed(); // Inclui registros "soft-deleted" no relacionamento 'categoria'
            },
            'categoria' => function ($query) {
                $query->withTrashed(); // Inclui registros "soft-deleted" no relacionamento 'categoria'
            },
            'atleta'
        ])->find($id); 
        
        return view('admin.inscricoes.add-peso', compact("inscricao"));
    }
    
    public function addPesoStore(Request $request)
    {
        $response = [
            'success' => true,
            'message' => '',
            'class' => '',
        ];

        try {

            $inscricao = AtletaXCampeonato::find($request->input("inscricao_id")); 

            $inscricao->peso = $request->input("peso");
            $inscricao->numero_atleta = $request->input("numero_atleta");
            $inscricao->save();       

            $response['message'] = 'Peso salvo com sucesso!';
            $response['class']= 'msg-sucesso';
        }
        catch (Exception $e) {
            Log::error($e);
            $response =  [
                'success' => false,
                'message' => 'Ops! Parece que houve. Por favor, tente novamente mais tarde.',
                'class' => 'msg-error',
            ];
        }
    
        return redirect()->route('admin.inscricoes')->with('response', $response);
    }    

    public function edit($id){
        $inscricao = AtletaXCampeonato::with(['campeonato', 'categoria', 'atleta'])->find($id); 

        return view('admin.inscricoes.edit-pagamento', compact("inscricao"));

    }

    public function addPagamentoStore(Request $request)
    {
        $response = [
            'success' => true,
            'message' => '',
            'class' => '',
        ];

        try {
            $inscricao = AtletaXCampeonato::find($request->input("inscricao_id")); 

            if($request->input("valor") !== '' &&$request->input("valor") !== null)
                $inscricao->value = $request->input("valor");

            if($request->input("convidado") == 'on')
                $inscricao->convidado = 1;
            else
                $inscricao->convidado = 0;
           
            $inscricao->status_pagamento = $request->input("status_pagamento");
            $inscricao->billingType = $request->input("forma_pagamento");
            $inscricao->save();       

            if( $request->input("status_pagamento") == 'CONFIRMED'){
                $atleta = Atleta::find($inscricao->atleta_id);

                $subCategoria = SubCategoria::find($inscricao->sub_categoria_id);

                $categoria = Categoria::find($subCategoria->categoria_id);

                $dadosEmail = [
                    'nome'=>  $atleta->nome,
                    'codigo' =>$inscricao->codigo,
                    'categoria' => $categoria,
                    'subcategoria' => $subCategoria->nome
                ];

                // Mail::to($atleta['email'])->send(new ConfirmacaoInscricao($dadosEmail));   
                $response['message'] = 'Informações salvas com sucesso! O atleta com a inscrição de código: '.$inscricao->codigo.' receberá um email com as informações da inscrição';

            }else
                $response['message'] = 'Informações do atleta com inscrição de código: '.$inscricao->codigo. ' salvas com sucesso!';

            $response['class']= 'msg-sucesso';
        }
        catch (Exception $e) {
            Log::error($e);
            $response =  [
                'success' => false,
                'message' => 'Ops! Parece que houve. Por favor, tente novamente mais tarde.',
                'class' => 'msg-error',
            ];
        }
    
        return redirect()->route('admin.inscricoes')->with('response', $response);
    }
    
}
