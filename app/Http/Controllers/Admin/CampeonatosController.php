<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campeonato;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Exception;

class CampeonatosController extends Controller
{
    public function index(){

        $campeonatos = Campeonato::all();

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

            $dados['data_inicio_inscricao'] = Carbon::createFromFormat('d/m/Y', $request->input('data_inicio_inscricao'))->format('Y-m-d');
            $dados['data_final_inscricao'] = Carbon::createFromFormat('d/m/Y', $request->input('data_final_inscricao'))->format('Y-m-d');
            $dados['data_campeonato'] = Carbon::createFromFormat('d/m/Y', $request->input('data_campeonato'))->format('Y-m-d');

            if (!empty($dados['id'])) 
                $categoria = Campeonato::updateOrCreate(['id' => $dados['id']], $dados);
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
