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

    public function primeiraEtapaInscricao(Request $request)
    {
        try {

            $campeonato = Campeonato::find($request->input('campeonato'));

            $atleta = $request->input();

            $atleta['cpf'] = str_replace(['.', '-'], '', $atleta['cpf'] );
            $atleta['rg'] = str_replace(['.', '-'], '', $atleta['rg'] );
            $atleta['celular'] = str_replace(['(',')', '-', ' '], '', $atleta['celular'] );
            $atleta['cep'] = str_replace(['(',')', '-', ' '], '', $atleta['cep'] );

            session()->put('atleta', $request->input());

            unset($atleta['_token']);        

            $atletaSave = Atleta::firstOrCreate(['cpf' =>  $atleta['cpf']], $atleta);

            if(!$atletaSave)
                throw new \Exception(('Ocorreu um erro para salvar os dados do atleta!'));
            
        } catch (\Exception $e) {
            $errorMessage = $e;
            $response = (object)['errorMessage' => $errorMessage];
        }

        return view('site.pagamento', compact([ 'campeonato' ]));
    }

    public function etapaPagamento(Request $request)
    {
        $retorno = [
            'success' => true,
            'message' => ''
        ];

        try {
            $dadosPagamento = $request->input();

            $validade = explode('/', $request->get('validade_cartao'));

            $atleta = session()->get('atleta');
            $cpf = str_replace(['.', '-'], '', $atleta['cpf'] );

            $campeonato = Campeonato::find($atleta['campeonato']);
            
            $dados = [
                'customer' => env('customer'),
                'billingType' => 'CREDIT_CARD',
                'value' => number_format( $campeonato->valor, 2, '.', '.'),
                'dueDate' => date('Y-m-d'),
                'installmentCount' => 1,
                'totalValue' => number_format( $campeonato->valor, 2, '.', '.'),
                'remoteIp' =>$request->ip(),
                'creditCard' => [
                    "holderName" => $request->get('nome_cartao'),
                    "number" => $request->get('numero_cartao'),
                    "expiryMonth" => $validade[0],
                    "expiryYear" => "20" . $validade[1],
                    "ccv" => $request->get('cvv'),
                ],
                'creditCardHolderInfo' => [
                    "name" => $atleta['nome'],
                    "email" => $atleta['email'],
                    "postalCode" => $atleta['cep'],
                    "addressNumber" => $atleta['cidade'] . '/'.  $atleta['estado']. ', '.  $atleta['bairro'] .' '.  $atleta['numero'] .' '.  $atleta['logradouro'] ,
                    "phone" => $atleta['celular'],
                    "cpfCnpj" => $cpf,
                ],
            ];

            $pagamentoRetorno = PagamentoService::sendPaymentRequest($dados);

            if(isset($pagamentoRetorno->errors[0]->code))
                throw new \Exception( $pagamentoRetorno->errors[0]->description);
            
            switch($pagamentoRetorno->status){
                case 'CONFIRMED': 
                    $atletaId = Atleta::where('cpf', $cpf )->pluck('id')->first();

                    $atletaXCampeonato = AtletaXCampeonato::create([
                        'campeonato_id' => $atleta['campeonato'],
                        'categoria_id' => $atleta['categorias'],
                        'atleta_id' => $atletaId,
                        'cupom_id' =>null,
                        'status_pagamento' =>'CONFIRMED',
                        'payment_id' => $pagamentoRetorno->id,
                        'customer' => $pagamentoRetorno->customer,
                        'billingType' => $pagamentoRetorno->billingType,
                        'value' => number_format( $campeonato->valor, 2, '.', '.'),
                        'dueDate' => $pagamentoRetorno->dueDate,
                        'installmentCount' => null,
                        'totalValue' => number_format( $campeonato->valor, 2, '.', '.'),
                        'remoteIp' =>$request->ip(),
                        'holderName' =>$request->get('nome_cartao'),
                        'creditCardNumber' => $pagamentoRetorno->creditCard->creditCardNumber,
                        'creditCardToken' =>  $pagamentoRetorno->creditCard->creditCardToken,
                        'creditCardBrand' =>$pagamentoRetorno->creditCard->creditCardBrand
                    ]);    

                    dd($pagamentoRetorno,$dadosPagamento, $atleta);

                    if(!$atletaXCampeonato)
                        throw new \Exception('Ops! Houve um erro interno. Por favor, tente novamente mais tarde. Se o problema persistir, entre em contato conosco para obter assistência. Lamentamos qualquer inconveniente');
                    
                    $retorno = [
                        'success' => true,
                        'message' => 'Inscrição concluída! Aguarde mais detalhes no seu e-mail em breve. Estamos empolgados com sua participação!',
                    ];

                    break;

                default:
                    throw new \Exception('Desculpe, o pagamento não foi confirmado. Certifique-se de fornecer as informações corretas do pagamento e tente novamente');
                    break;

            }

        } catch (\Exception $e) {    
            
            $retorno = [
                'success' => false,
                'message' => $e,
                'cartao' => [
                    "nome" => $request->get('nome_cartao'),
                    "numero" => $request->get('numero_cartao'),
                    "validade" => $request->get('validade_cartao'),
                    "ccv" => $request->get('cvv'),
                ],
            ];

            return view('site.pagamento', compact([ 'campeonato','retorno' ]));
        }
    }
}
