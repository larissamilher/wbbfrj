<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evento;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Exception;
use DateTime;
use App\Models\InscricaoEvento;
use PDF;
use Illuminate\Support\Facades\View;
use App\Exports\ListagemExportEvento;
use Maatwebsite\Excel\Facades\Excel;

class EventosController extends Controller
{
    public function index(){

        $eventos = Evento::orderBy('nome')->get();

        return view('admin.eventos.index', compact('eventos'));
    }

    public function create(){
        return view('admin.eventos.novo');
    }

    public function edit($id){
        $evento = Evento::find($id);
        return view('admin.eventos.novo', compact('evento'));
    }

    public function delete($id){

        $response = [
            'success' => true,
            'message' => '',
            'class' => '',
        ];

        try {

            $evento = Evento::find($id);

            if ($evento) 
                $evento->delete();            

            $response['message'] = 'Evento deletado com sucesso!';
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
    
        return redirect()->route('admin.eventos')->with('response', $response);
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

                $evento = Evento::find($dados['id']);
                
                if($request->input('data_inicio_inscricao') == date("d/m/Y", strtotime( $evento->data_inicio_inscricao)))
                    $dados['data_inicio_inscricao'] = Carbon::createFromFormat('d/m/Y', $request->input('data_inicio_inscricao'))->format('Y-m-d');

                if($request->input('data_final_inscricao') == date("d/m/Y", strtotime( $evento->data_final_inscricao)))
                    $dados['data_final_inscricao'] = Carbon::createFromFormat('d/m/Y', $request->input('data_final_inscricao'))->format('Y-m-d');

                if($request->input('data_evento') == date("d/m/Y", strtotime( $evento->data_evento)))
                    $dados['data_evento'] = Carbon::createFromFormat('d/m/Y', $request->input('data_evento'))->format('Y-m-d');
                
                $categoria = Evento::updateOrCreate(['id' => $dados['id']], $dados);
            }
            else 
                Evento::create($dados);
                    
            $response['message'] = 'Evento salvo com sucesso!';
        }
        catch (Exception $e) {
            Log::error($e);
            $response =  [
                'success' => false,
                'message' => 'Ops! Parece que houve. Por favor, tente novamente mais tarde.',
                'class' => 'msg-error',
            ];
        }
    
        return view('admin.eventos.novo', compact('response'));
        
    }

    public function inscricoes($eventoId = null, $codigo = null){

        $eventos = Evento::orderBy('nome')->get();

        $inscricoes = InscricaoEvento::with([
            'evento' => function ($query) {
                $query->withTrashed(); // Inclui registros "soft-deleted" no relacionamento 'categoria'
            },
        ]);
        
        if($eventoId)
            $inscricoes = $inscricoes->where('evento_id', $eventoId);        


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
