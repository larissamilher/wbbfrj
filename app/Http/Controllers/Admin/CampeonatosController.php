<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campeonato;

class CampeonatosController extends Controller
{
    public function index(){

        $campeonatos = Campeonato::all();

        return view('admin.campeonatos.index', compact('campeonatos'));
    }

    public function create(){
        return view('admin.campeonatos.novo');
    }

    public function store(Request $request){

        $response = [
            'success' => true,
            'message' => 'Campeonato criado com sucesso!',
            'class' => 'msg-sucesso',
        ];

        try {
            $dados = $request->input();

            unset($dados['_token']);

            $dados['valor'] = str_replace(',', '.', $dados['valor']);
            Campeonato::create($dados);
                    
            $mensagem = 'Campeonato criado com sucesso!';
            $class= 'msg-sucesso';
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
