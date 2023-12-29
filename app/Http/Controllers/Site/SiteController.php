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

    public function ingresso($id)
    {      
        $inscricao = InscricaoEvento::with([
            'evento' => function ($query) {
                $query->withTrashed();
            },
        ])->find($id);
        
        $conteudo = 'https://wbbfrj.com/eventos/validar/'. str_replace('/', '-', $inscricao->codigo);
        $qrCode = QrCode::size(300)->generate($conteudo);

        $nome = str_replace('/', '-', $inscricao->codigo);
        $qrCodePath = storage_path("app/temp/{$nome}.png");
        file_put_contents($qrCodePath, $qrCode);

        $pdfView = view('ingresso.ingresso', ['inscricao' => $inscricao, 'qrCodePath' => $qrCodePath])->render();
        
        $pdf = PDF::loadHTML($pdfView);
        
      
        $pdfPath = storage_path("app/temp/{$nome}.pdf");
        $pdf->save($pdfPath);

        return $pdf->stream($nome . '.pdf');

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
        $conteudo = 'https://wbbfrj.com/eventos/validar/'. str_replace('/', '-', $inscricao->codigo);
        $qrCode = QrCode::size(300)->generate($conteudo);
    
        return view('ingresso.ingresso', compact("qrCode","inscricao")); 
       

    }

    public function validarCompra($codigo = null)
    {
        if(!$codigo){
            $semCondigo = true;
            return view('site.eventos.compra-validar', compact('semCondigo')); 

        }
        
        $semCondigo = false;
        $compra = InscricaoEvento::with([
            'evento' => function ($query) {
                $query->withTrashed();
            },
        ])->where('codigo', str_replace('-', '/',$codigo ))->first();

        return view('site.eventos.compra-validar', compact("compra",'semCondigo')); 
    }

    
    public function validarCompraAcao($id)
    {
        $retorno = [
            'success' => true,
            'message' => ''
        ];

        try {
        
            $compra = InscricaoEvento::find($id);

            if(!$compra)
                throw new \Exception('Compra/Ingresso não encontrado!');

            if(!empty($compra->data_usado))
                throw new \Exception(' Erro: Este ingresso já foi utilizado. Certifique-se de não haver duplicatas.');

            $compra->usado = 1;
            $compra->data_usado = date('Y-m-d');
            $compra->save();

        } catch (\Exception $e) {    
            Log::error($e);

            $retorno = [
                'success' => false,
                'message' =>  $e->getMessage()
            ];
        }

        return $retorno;
    }

    public function contato(Request $request)
    {       
        Mail::to('contato@wbbfrj.com')->send(new Contato($request->input()));

        return redirect()->back()->with('success', 'Mensagem enviada com sucesso!');

    }

}
