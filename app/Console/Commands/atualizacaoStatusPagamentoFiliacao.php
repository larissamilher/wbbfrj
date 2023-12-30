<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\ConfirmacaoInscricaoFiliacao;
use App\Models\Filiacao;
use App\Models\Filiado;
use App\Models\Atleta;
use App\Services\PagamentoService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use DateTime;
use PDF;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class atualizacaoStatusPagamentoFiliacao extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:atualizacao-status-pagamento-filiacao';

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
        $pagamentosPendentes = Filiado::where('status_pagamento', 'PENDING')->get();
        
        foreach($pagamentosPendentes as $pagamento){
            $pagamentoRetorno = PagamentoService::obterSatusPagamento($pagamento->payment_id);
            $pagamento->status_pagamento = $pagamentoRetorno->status;
            $pagamento->save();

            if($pagamentoRetorno->status == 'CONFIRMED' || $pagamentoRetorno->status == 'RECEIVED'){

                $atleta = Atleta::find($pagamento->atleta_id);

                $participanteFiliado = Filiado::with([
                    'filiacao' => function ($query) {
                        $query->withTrashed();
                    },
                ])->find($pagamento->id);

                Mail::to($atleta['email'])->send(new ConfirmacaoInscricaoFiliacao($participanteFiliado));
            }
        }
        Log::info("rodou command");
    }
}
