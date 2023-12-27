<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campeonato;
use App\Models\AtletaXCampeonato;
use App\Models\Categoria;
use App\Models\Atleta;
use PhpOffice\PhpSpreadsheet\Exception;
use App\Models\Evento;
use Illuminate\Support\Facades\View;
use PDF;
use App\Models\InscricaoEvento;

class RelatoriosController extends Controller
{
    public function index(){

        $campeonatos = Campeonato::orderBy('nome')->get();
        $eventos = Evento::orderBy('nome')->get();

        return view('admin.relatorios.index', compact('campeonatos','eventos'));
    }

    public function gerarPdf($tipo, $id)
    {
        $retorno = [];
                
        if($tipo == 'campeonato'){

            $retorno['candidaturas'] = AtletaXCampeonato::where('campeonato_id',$id)
                ->whereIn('status_pagamento', ['CONFIRMED','RECEIVED'])
                ->count();

            $retorno['pix'] = AtletaXCampeonato::where('campeonato_id',$id)
                ->whereIn('status_pagamento', ['CONFIRMED','RECEIVED'])
                ->where('billingType', 'PIX')
                ->whereNull('convidado')
                ->count();

            $retorno['boleto'] = AtletaXCampeonato::where('campeonato_id',$id)
                ->whereIn('status_pagamento', ['CONFIRMED','RECEIVED'])
                ->where('billingType', 'BOLETO')
                ->whereNull('convidado')
                ->count();
    
            $retorno['cartao'] = AtletaXCampeonato::where('campeonato_id',$id)
                ->whereIn('status_pagamento', ['CONFIRMED','RECEIVED'])
                ->where('billingType', 'CREDIT_CARD')
                ->whereNull('convidado')
                ->count();
            
            $retorno['convidados'] = AtletaXCampeonato::where('campeonato_id',$id)
                ->whereIn('status_pagamento', ['CONFIRMED','RECEIVED'])
                ->whereNotNull('convidado')
                ->count();
            

            $retorno['valor-pix'] = AtletaXCampeonato::where('campeonato_id', $id)
                ->whereIn('status_pagamento', ['CONFIRMED', 'RECEIVED'])
                ->where('billingType', 'PIX')
                ->whereNull('convidado')
                ->sum('VALUE');

                
            $retorno['valor-boleto'] = AtletaXCampeonato::where('campeonato_id', $id)
                ->whereIn('status_pagamento', ['CONFIRMED', 'RECEIVED'])
                ->where('billingType', 'BOLETO')
                ->whereNull('convidado')
                ->sum('VALUE');

            $retorno['valor-cartao'] = AtletaXCampeonato::where('campeonato_id', $id)
                ->whereIn('status_pagamento', ['CONFIRMED', 'RECEIVED'])
                ->where('billingType', 'CREDIT_CARD')
                ->whereNull('convidado')
                ->sum('VALUE');

            $retorno['valor-total'] = AtletaXCampeonato::where('campeonato_id', $id)
                ->whereIn('status_pagamento', ['CONFIRMED', 'RECEIVED'])
                ->whereNull('convidado')
                ->sum('VALUE');
        
        }
        else if($tipo == 'evento'){
            
            $retorno['candidaturas'] = InscricaoEvento::where('campeonato_id',$id)
                ->whereIn('status_pagamento', ['CONFIRMED','RECEIVED'])
                ->count();

            $retorno['pix'] = InscricaoEvento::where('campeonato_id',$id)
                ->whereIn('status_pagamento', ['CONFIRMED','RECEIVED'])
                ->where('billingType', 'PIX')
                ->whereNull('convidado')
                ->count();

            $retorno['boleto'] = InscricaoEvento::where('campeonato_id',$id)
                ->whereIn('status_pagamento', ['CONFIRMED','RECEIVED'])
                ->where('billingType', 'BOLETO')
                ->whereNull('convidado')
                ->count();
    
            $retorno['cartao'] = InscricaoEvento::where('campeonato_id',$id)
                ->whereIn('status_pagamento', ['CONFIRMED','RECEIVED'])
                ->where('billingType', 'CREDIT_CARD')
                ->whereNull('convidado')
                ->count();
            
            $retorno['convidados'] = InscricaoEvento::where('campeonato_id',$id)
                ->whereIn('status_pagamento', ['CONFIRMED','RECEIVED'])
                ->whereNotNull('convidado')
                ->count();
            

            $retorno['valor-pix'] = InscricaoEvento::where('campeonato_id', $id)
                ->whereIn('status_pagamento', ['CONFIRMED', 'RECEIVED'])
                ->where('billingType', 'PIX')
                ->whereNull('convidado')
                ->sum('VALUE');

                
            $retorno['valor-boleto'] = InscricaoEvento::where('campeonato_id', $id)
                ->whereIn('status_pagamento', ['CONFIRMED', 'RECEIVED'])
                ->where('billingType', 'BOLETO')
                ->whereNull('convidado')
                ->sum('VALUE');

            $retorno['valor-cartao'] = InscricaoEvento::where('campeonato_id', $id)
                ->whereIn('status_pagamento', ['CONFIRMED', 'RECEIVED'])
                ->where('billingType', 'CREDIT_CARD')
                ->whereNull('convidado')
                ->sum('VALUE');

            $retorno['valor-total'] = InscricaoEvento::where('campeonato_id', $id)
                ->whereIn('status_pagamento', ['CONFIRMED', 'RECEIVED'])
                ->whereNull('convidado')
                ->sum('VALUE');
        }

    
        $pdfView = View::make('admin.relatorios.pdf',  ['retorno' => $retorno])->render();

        $pdf = PDF::loadHTML($pdfView);

        // return view('admin.relatorios.pdf', compact('retorno'));
        return $pdf->download('relatório.pdf');

    }
}
