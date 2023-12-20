<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campeonato;
use App\Models\CategoriaCampeonato;
use App\Services\PagamentoService;
use App\Models\Atleta;
use App\Models\AtletaXCampeonato;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contato;
use Illuminate\Support\Facades\Log;

class SiteController extends Controller
{
    public function index()
    {      
        $campeonato = Campeonato::where('data_inicio_inscricao', '<=', now())
        ->where('data_final_inscricao', '>=', now())
        ->orderByRaw('ABS(TIMESTAMPDIFF(SECOND, data_campeonato, NOW()))')
        ->first();

        return view('site.index', compact([ 'campeonato' ]));        
    }

    public function contato(Request $request)
    {       
        Mail::to('contato@wbbfrj.com')->send(new Contato($request->input()));

        return redirect()->back()->with('success', 'Mensagem enviada com sucesso!');

    }

}
