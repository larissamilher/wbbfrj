<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\InscricaoEvento;
use App\Models\Atleta;
use App\Services\PagamentoService;
use App\Models\Categoria;
use App\Models\SubCategoria;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmacaoInscricaoEvento;
use Illuminate\Support\Facades\Log;
use DateTime;
use PDF;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class atualizaStatusPagamentoEvento extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:atualiza-status-pagamento-evento';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pagamentosPendentes = InscricaoEvento::where('status_pagamento', 'PENDING')->get();
        
        foreach($pagamentosPendentes as $pagamento){
            $pagamentoRetorno = PagamentoService::obterSatusPagamento($pagamento->payment_id);
            $pagamento->status_pagamento = $pagamentoRetorno->status;
            $pagamento->save();

            if($pagamentoRetorno->status == 'CONFIRMED' || $pagamentoRetorno->status == 'RECEIVED'){

                $nome = str_replace('/', '-', $pagamento->codigo);

                $participanteEvento = InscricaoEvento::with([
                    'evento' => function ($query) {
                        $query->withTrashed();
                    },
                ])->find($pagamento->id);
                
                $conteudo = 'https://wbbfrj.com/eventos/validar/'. $nome;
                $qrCode = QrCode::size(300)->generate($conteudo);

                $qrCodePath = storage_path("app/temp/{$nome}.png");
                file_put_contents($qrCodePath, $qrCode);

                $pdfView = view('ingresso.ingresso', ['inscricao' => $participanteEvento, 'qrCodePath' => $qrCodePath])->render();

                $pdf = PDF::loadHTML($pdfView);
                
                $pdfPath = storage_path("app/temp/{$nome}.pdf");
                $pdf->save($pdfPath);              

                Mail::to($pagamento->email)->send(new ConfirmacaoInscricaoEvento($participanteEvento, $pdfPath, $nome));
                
                Storage::delete("temp/{$nome}.pdf");
                Storage::delete("temp/{$nome}.png");
            }
        }
        Log::info("rodou command");
    }
    
}
