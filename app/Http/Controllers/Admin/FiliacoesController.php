<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Filiacao;
use App\Models\Filiados;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Exception;
use DateTime;
use App\Models\InscricaoEvento;
use PDF;
use Illuminate\Support\Facades\View;
use App\Exports\ListagemExportEvento;
use Maatwebsite\Excel\Facades\Excel;

class FiliacoesController extends Controller
{
    public function index(){

        $filiacoes = Filiacao::orderBy('nome')->get();

        return view('admin.filiacoes.index', compact('filiacoes'));
    }

    public function create(){
        return view('admin.filiacoes.novo');
    }

    public function edit($id){
        $filiacao = Filiacao::find($id);
        return view('admin.filiacoes.novo', compact('filiacao'));
    }

    public function delete($id){

        $response = [
            'success' => true,
            'message' => '',
            'class' => '',
        ];

        try {

            $filiacao = Filiacao::find($id);

            if ($filiacao) 
                $filiacao->delete();            

            $response['message'] = 'Filiação deletada com sucesso!';
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
    
        return redirect()->route('admin.filiacao')->with('response', $response);
    }

    public function store(Request $request){

        $response = [
            'success' => true,
            'message' => '',
            'class' => 'msg-sucesso',
        ];

        try {
            $dados = $request->input();

            unset($dados['_token']);

            $dados['valor'] = str_replace(',', '.', $dados['valor']);


            if (!empty($dados['id'])) {

                $evento = Filiacao::find($dados['id']);
                
                if($request->input('data_inicio_inscricao') == date("d/m/Y", strtotime( $evento->data_inicio_inscricao)))
                    $dados['data_inicio_inscricao'] = Carbon::createFromFormat('d/m/Y', $request->input('data_inicio_inscricao'))->format('Y-m-d');

                if($request->input('data_final_inscricao') == date("d/m/Y", strtotime( $evento->data_final_inscricao)))
                    $dados['data_final_inscricao'] = Carbon::createFromFormat('d/m/Y', $request->input('data_final_inscricao'))->format('Y-m-d');

                if($request->input('validade') == date("d/m/Y", strtotime( $evento->validade)))
                    $dados['validade'] = Carbon::createFromFormat('d/m/Y', $request->input('validade'))->format('Y-m-d');
                
                $categoria = Filiacao::updateOrCreate(['id' => $dados['id']], $dados);
            }
            else 
                Filiacao::create($dados);
                    
            $response['message'] = 'Filiação salvo com sucesso!';
        }
        catch (Exception $e) {
            Log::error($e);
            $response =  [
                'success' => false,
                'message' => 'Ops! Parece que houve. Por favor, tente novamente mais tarde.',
                'class' => 'msg-error',
            ];
        }
    
        return view('admin.filiacoes.novo', compact('response'));
        
    }

    public function cadastros($filiacaoId = null, $codigo = null){

        $filiacaos = Filiacao::orderBy('nome')->get();

        $inscricoes = Filiados::with([
            'filiacao' => function ($query) {
                $query->withTrashed(); // Inclui registros "soft-deleted" no relacionamento 'categoria'
            },
        ]);
        
        if($filiacaoId)
            $inscricoes = $inscricoes->where('filiacao_id', $filiacaoId);        


        if($codigo)
            $inscricoes = $inscricoes->where('codigo', str_replace('-', '/', $codigo));

        $inscricoes = $inscricoes->orderBy('nome')->get();
        
        return view('admin.eventos.inscricoes', compact('eventos','inscricoes'));
    }

    public function gerarPdf($id){

        $inscricao = InscricaoEvento::with([
            'evento' => function ($query) {
                $query->withTrashed(); // Inclui registros "soft-deleted" no relacionamento 'categoria'
            },
        ])->find($id); 

        $pdfView = View::make('admin.eventos.detalhes-pdf',  ['inscricao' => $inscricao])->render();

        $pdf = PDF::loadHTML($pdfView);

        $nome = $inscricao->codigo;

        if(empty($nome))
            $nome = 'ficha-inscricao';

        return $pdf->download($nome.'.pdf');

    }

    public function extrairListagemTela()
    {
        $eventos = Evento::all();

        return view('admin.eventos.extrair-listagem', compact("eventos"));
    }

    public function extrairListagem(Request $request)
    {
        $eventoId = $request->input('evento');

        $nomeEvento = Evento::find($eventoId);

        $export = new ListagemExportEvento($eventoId);

        return Excel::download(new ListagemExportEvento($eventoId), $nomeEvento->nome . '.xlsx');
    }
}
