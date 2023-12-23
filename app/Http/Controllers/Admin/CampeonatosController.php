<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campeonato;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Exception;
use DateTime;

class CampeonatosController extends Controller
{
    public function index(){

        $campeonatos = Campeonato::orderBy('nome')->get();

        return view('admin.campeonatos.index', compact('campeonatos'));
    }

    public function create(){
        return view('admin.campeonatos.novo');
    }

    public function edit($id){
        $campeonato = Campeonato::find($id);
        return view('admin.campeonatos.novo', compact('campeonato'));
    }

    public function delete($id){

        $response = [
            'success' => true,
            'message' => '',
            'class' => '',
        ];

        try {

            $campeonato = Campeonato::find($id);

            if ($campeonato) 
                $campeonato->delete();            

            $response['message'] = 'Campeonato deletado com sucesso!';
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
    
        return redirect()->route('admin.campeonatos')->with('response', $response);
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

                $campeonato = Campeonato::find($dados['id']);
                
                if($request->input('data_inicio_inscricao') == date("d/m/Y", strtotime( $campeonato->data_inicio_inscricao)))
                    $dados['data_inicio_inscricao'] = Carbon::createFromFormat('d/m/Y', $request->input('data_inicio_inscricao'))->format('Y-m-d');

                if($request->input('data_final_inscricao') == date("d/m/Y", strtotime( $campeonato->data_final_inscricao)))
                    $dados['data_final_inscricao'] = Carbon::createFromFormat('d/m/Y', $request->input('data_final_inscricao'))->format('Y-m-d');

                if($request->input('data_campeonato') == date("d/m/Y", strtotime( $campeonato->data_campeonato)))
                    $dados['data_campeonato'] = Carbon::createFromFormat('d/m/Y', $request->input('data_campeonato'))->format('Y-m-d');
                
                $categoria = Campeonato::updateOrCreate(['id' => $dados['id']], $dados);
            }
            else 
                Campeonato::create($dados);
                    
            $response['message'] = 'Campeonato salvo com sucesso!';
        }
        catch (Exception $e) {
            Log::error($e);
            $response =  [
                'success' => false,
                'message' => 'Ops! Parece que houve. Por favor, tente novamente mais tarde.',
                'class' => 'msg-error',
            ];
        }
    
        return view('admin.campeonatos.novo', compact('response'));
        
    }
}
