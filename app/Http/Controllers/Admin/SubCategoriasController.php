<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategoria;
use App\Models\Categoria;

use PhpOffice\PhpSpreadsheet\Exception;

class SubCategoriasController extends Controller
{
    public function index(){
        $subcategorias = SubCategoria::all();

        return view('admin.subcategorias.index', compact("subcategorias"));
    }

    public function create(){
        $categorias = Categoria::all();
        return view('admin.subcategorias.novo', compact('categorias'));
    }

    public function edit($id){
        $subcategoria = SubCategoria::find($id);
        return view('admin.subcategorias.novo', compact('subcategoria'));
    }

    public function delete($id){

        $response = [
            'success' => true,
            'message' => '',
            'class' => '',
        ];

        try {

            $subcategoria = SubCategoria::find($id);

            if ($subcategoria) 
                $subcategoria->delete();
            
            $response['message'] = 'SubCategoria deletada com sucesso!';
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
    
        return redirect()->route('admin.subcategorias')->with('response', $response);
    }

    public function store(Request $request){

        $response = [
            'success' => true,
            'message' => '',
            'class' => '',
        ];

        try {
            $categorias = Categoria::all();

            $dados = $request->input();

            unset($dados['_token']);

            if (!empty($dados['id'])) 
                $categoria = SubCategoria::updateOrCreate(['id' => $dados['id']], $dados);
            else 
                SubCategoria::create($dados);
                                
            $response['message'] = 'SubCategoria salva com sucesso!';
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
    
        return view('admin.subcategorias.novo', compact('response', 'categorias'));
        
    }
}
