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

    public function edit($id){
        $categoria = Categoria::find($id);
        return view('admin.categorias.novo', compact('categoria'));
    }

    public function delete($id){

        $response = [
            'success' => true,
            'message' => '',
            'class' => '',
        ];

        try {

            $categoria = Categoria::find($id);

            if ($categoria) 
                $categoria->delete();
            
            $response['message'] = 'Categoria deletada com sucesso!';
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
    
        return redirect()->route('admin.categorias')->with('response', $response);
    }

    public function store(Request $request){

        $response = [
            'success' => true,
            'message' => '',
            'class' => '',
        ];

        try {
            $dados = $request->input();

            unset($dados['_token']);

            if (!empty($dados['id'])) 
                $categoria = Categoria::updateOrCreate(['id' => $dados['id']], $dados);
            else 
                Categoria::create($dados);
                                
            $response['message'] = 'Categoria salva com sucesso!';
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
    
        return view('admin.categorias.novo', compact('response'));
        
    }
}
