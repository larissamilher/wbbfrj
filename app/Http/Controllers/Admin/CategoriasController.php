<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriasController extends Controller
{
    public function index(){
        $categorias = Categoria::all();

        return view('admin.categorias.index', compact("categorias"));
    }

    public function create(){
        return view('admin.categorias.novo');
    }

    public function store(Request $request){

        $response = [
            'success' => true,
            'message' => 'Categoria criada com sucesso!',
            'class' => 'msg-sucesso',
        ];

        try {
            $dados = $request->input();

            unset($dados['_token']);

            Categoria::create($dados);
                    
            $mensagem = 'Categoria criada com sucesso!';
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
    
        return view('admin.categorias.novo', compact('response'));
        
    }
}
