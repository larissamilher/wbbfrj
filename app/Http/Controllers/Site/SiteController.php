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
use PDF;
use Illuminate\Support\Facades\View;
use PhpOffice\PhpSpreadsheet\Exception;
use App\Models\Evento;
use App\Models\InscricaoEvento;
use App\Mail\ConfirmacaoInscricaoEvento;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

    public function ingresso()
    {      
        // $participanteEvento = InscricaoEvento::with([
        //     'evento' => function ($query) {
        //         $query->withTrashed();
        //     },
        // ])->find(1);
        
        // $pdfView = view('ingresso.ingresso', ['inscricao' => $participanteEvento])->render();
        
        // $pdf = PDF::loadHTML($pdfView);
        
        // $nome = str_replace('/', '-', $participanteEvento->codigo);
        // $pdfPath = storage_path("app/temp/{$nome}.pdf");
        // $pdf->save($pdfPath);

        // $participante = [
        //     'email' => 'larissamilher@gmail.com',
        //     'codigo' => '0955004/2023'
        // ];
        
        // // $participanteEvento = InscricaoEvento::find(1);

        // Mail::to($participante['email'])
        //     ->send(new ConfirmacaoInscricaoEvento($participanteEvento, $pdfPath, $nome));
        
        // Storage::delete("temp/{$nome}.pdf");
        
        // return 'E-mail enviado com sucesso!';

        // return view('ingresso.ingresso'); 
        $conteudo = 'teste texto qr codee';

        // Gera o QR code
        $qrCode = QrCode::size(300)->generate($conteudo);
    
        return view('ingresso.ingresso', compact("qrCode")); 
       

    }

    public function validarCompra($codigo)
    {
        $compra = InscricaoEvento::with([
            'evento' => function ($query) {
                $query->withTrashed();
            },
        ])->where('codigo', str_replace('-', '/',$codigo ))->first();

        return view('site.eventos.compra-validar', compact("compra")); 

        dd( $participanteEvento);
    }

    public function contato(Request $request)
    {       
        Mail::to('contato@wbbfrj.com')->send(new Contato($request->input()));

        return redirect()->back()->with('success', 'Mensagem enviada com sucesso!');

    }

}
