<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Campeonato;
use App\Models\SubCategoria;
use App\Models\SubCategoriaCampeonato;
use PhpOffice\PhpSpreadsheet\Exception;

class CategoriasController extends Controller
{
    public function index(){
        $categorias = Categoria::orderBy('nome')->get();
        $campeonatos = Campeonato::orderBy('nome')->get();
        return view('admin.categorias.index', compact("categorias",'campeonatos'));
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

    public function addCampeonato($categoriaId, $campeonatoId)
    {
        try {

            $subcategorias = SubCategoria::where('categoria_id', $categoriaId)->get();

            foreach($subcategorias as $subcategoria){
                $verifica = SubCategoriaCampeonato::where('campeonato_id', $campeonatoId)
                ->where('sub_categoria_id', $subcategoria->id)->first();

                if (!$verifica) {
                    SubCategoriaCampeonato::create([
                        'campeonato_id' => $campeonatoId,
                        'sub_categoria_id' => $subcategoria->id
                    ]);
                }
            }
           
            return [
                'success' => true,
                'message' => 'Registro salvo com sucesso!'
            ];

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

}
