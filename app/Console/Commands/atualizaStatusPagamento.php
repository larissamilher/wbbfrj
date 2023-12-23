<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AtletaXCampeonato;
use App\Services\PagamentoService;

class atualizaStatusPagamento extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:atualiza-status-pagamento';

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
        $pagamentosPendentes = AtletaXCampeonato::where('status_pagamento', 'PENDING')->get();
        
        foreach($pagamentosPendentes as $pagamento){
            $pagamentoRetorno = PagamentoService::obterSatusPagamento($pagamento->payment_id);
            $pagamento->status_pagamento = $pagamentoRetorno->status;
            $pagamento->save();
        }
    }
}
