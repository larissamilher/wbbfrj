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

            if($pagamentoRetorno->status == 'CONFIRMED' || $pagamentoRetorno->status == 'RECEIVED')
                Mail::to($pagamento->email)->send(new ConfirmacaoInscricaoEvento($pagamento));
        }
        Log::info("rodou command");
    }
    
}
