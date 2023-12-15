<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campeonato;
use App\Models\CategoriaCampeonato;

class InscricaoController extends Controller
{
    public function index(){
        
        $campeonatos = Campeonato::where('data_inicio_inscricao', '<=', now())
            ->where('data_final_inscricao', '>=', now())
            ->get();

        return view('site.inscricao', compact([ 'campeonatos' ]));
        
    }

    public function getCategoriasCampeonato($campeonatoId)
    {
        $response = [
            'success' => true,
            'message' => 'Dados buscados com sucesso'
        ];

        try{
            $categorias = CategoriaCampeonato::with('categoria')
            ->where('campeonato_id', $campeonatoId)
            ->get();
    
            $response['dados'] = $categorias;

        }catch (Exception $e) {
            Log::error($e);
            return [
                'success' => false,
                'message' => 'Ops! Parece que houve um problema ao buscar os horários. Por favor, tente novamente mais tarde.'
            ];
        }

        return $response;


    }
}
