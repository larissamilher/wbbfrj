<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AtletaXCampeonato;
use App\Models\Atleta;
use App\Services\PagamentoService;
use App\Models\Categoria;
use App\Models\SubCategoria;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmacaoInscricao;

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

            if($pagamentoRetorno->status == 'CONFIRMED'){

                $atleta = Atleta::find($pagamento->atleta_id);
                $subCategoria = SubCategoria::find($pagamento->sub_categoria_id);

                $categoria = Categoria::find($subCategoria->categoria_id);

                $dadosEmail = [
                    'nome'=>  $atleta->nome,
                    'codigo' =>$pagamento->codigo,
                    'categoria' => $categoria,
                    'subcategoria' => $subCategoria->nome
                ];

                Mail::to($atleta['email'])->send(new ConfirmacaoInscricao($dadosEmail));        
            }

            echo 'foi';
        }
        echo 'foi command';
        Log::info("rodou command");
    }
}
