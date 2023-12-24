<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategoria;
use App\Models\Categoria;
use App\Models\Campeonato;
use App\Models\SubCategoriaCampeonato;

use PhpOffice\PhpSpreadsheet\Exception;
use Illuminate\Support\Facades\Log;

class SubCategoriasController extends Controller
{
    public function index($categoriaId = null){
        $categorias = Categoria::orderBy('nome')->get();

        $subcategorias = SubCategoria::with([
            'categoria' => function ($query) {
                $query->withTrashed(); // Inclui registros "soft-deleted" no relacionamento 'categoria'
            }
        ])->orderBy('nome');
        $campeonatos = Campeonato::orderBy('nome')->get();

        if($categoriaId)
            $subcategorias =$subcategorias->where('categoria_id',$categoriaId);

        $subcategorias =$subcategorias->get();

        return view('admin.subcategorias.index', compact("subcategorias",'categorias','campeonatos'));
    }

    public function create(){
        $categorias = Categoria::all();
        return view('admin.subcategorias.novo', compact('categorias'));
    }

    public function edit($id){
        $categorias = Categoria::all();
        $subcategoria = SubCategoria::find($id);
        return view('admin.subcategorias.novo', compact('subcategoria','categorias'));
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
            Log::error($e->getMessage());
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

    public function addCampeonato($subCategoriaId, $campeonatoId)
    {
        try {
            $verifica = SubCategoriaCampeonato::where('campeonato_id', $campeonatoId)
                ->where('sub_categoria_id', $subCategoriaId)->first();

            if ($verifica) {
                return [
                    'success' => false,
                    'message' => 'SubCategoria já inserida ao campeonato selecionado!'
                ];
            }

            SubCategoriaCampeonato::create([
                'campeonato_id' => $campeonatoId,
                'sub_categoria_id' => $subCategoriaId
            ]);

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
