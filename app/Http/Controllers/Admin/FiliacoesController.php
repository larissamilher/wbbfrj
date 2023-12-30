<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Filiacao;
use App\Models\Filiado;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Exception;
use DateTime;
use App\Models\InscricaoEvento;
use PDF;
use Illuminate\Support\Facades\View;
use App\Exports\ListagemExportEvento;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

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

    public function cadastros($filiacaoId = null, $codigo = null)
    {
        $filiacoes = Filiacao::orderBy('nome')->get();

        $inscricoes = Filiado::with([
            'filiacao' => function ($query) {
                $query->withTrashed(); // Inclui registros "soft-deleted" no relacionamento 'categoria'
            },
        ])->join('atletas', 'atletas.id', '=', 'filiados.atleta_id')
        ->orderBy('atletas.nome') 
        ->select("filiados.*");
        
        if($filiacaoId)
            $inscricoes = $inscricoes->where('filiacao_id', $filiacaoId);    

        if($codigo)
            $inscricoes = $inscricoes->where('codigo', str_replace('-', '/', $codigo));

        $inscricoes = $inscricoes->get();
        
        return view('admin.filiacoes.cadastros', compact('filiacoes','inscricoes'));
    }

    public function detalhes($id)
    {
        $inscricao = Filiado::with([
            'filiacao' => function ($query) {
                $query->withTrashed(); 
            },
            'atleta'
        ])->find($id); 

        return view('admin.filiacoes.filiados.detalhes', compact("inscricao"));
    }

    public function verSelfie($id){

        $inscricao = Filiado::find($id); 

        $imageContent = base64_decode($inscricao->selfie);

        $response = Response::make($imageContent, 200);
        $response->header('Content-Type', 'image/jpeg'); // Certifique-se de ajustar conforme o tipo da sua imagem

        return $response;
    }

    public function downloadSelfie($id)
    {
        $filiado = Filiado::find($id);
    
        if (!$filiado) 
            abort(404); 
    
        $imageContent = base64_decode($filiado->selfie);    
        $fileName = 'selfie_' . $filiado->id . '.jpg';     
        $response = Response::download(
            $this->base64ToFile($imageContent, $fileName),
            $fileName,
            ['Content-Type' => 'image/jpeg'] 
        );    
        return $response;
    }
    
    private function base64ToFile($base64Content, $fileName)
    {
        $tempFilePath = tempnam(sys_get_temp_dir(), $fileName);    
        file_put_contents($tempFilePath, $base64Content);    
        return $tempFilePath;
    }

    public function gerarPdf($id){

        $inscricao = Filiado::with([
            'filiacao' => function ($query) {
                $query->withTrashed(); 
            },
            'atleta'
        ])->find($id);

        $pdfView = View::make('admin.filiacoes.filiados.detalhes-pdf',  ['inscricao' => $inscricao])->render();

        $pdf = PDF::loadHTML($pdfView);

        $nome = $inscricao->codigo;

        if(empty($nome))
            $nome = 'ficha-filiado';

        // return view('admin.filiacoes.filiados.detalhes-pdf', compact("inscricao"));

        return $pdf->download($nome.'.pdf');

    }

}
