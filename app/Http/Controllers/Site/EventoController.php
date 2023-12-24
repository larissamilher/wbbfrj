<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InscricaoEvento;
use App\Services\PagamentoService;
use App\Services\GeradorCodigoService;
use App\Models\Evento;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmacaoInscricao;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Exception;

class EventoController extends Controller
{
    public function index(){
        
        $eventos = Evento::where('data_inicio_inscricao', '<=', now())
            ->where('data_final_inscricao', '>=', now())
            ->get();

        return view('site.eventos.inscricao', compact([ 'eventos' ]));        
    }

    public function primeiraEtapaInscricao(Request $request)
    {
        try {

            $evento = Evento::find($request->input('evento_id'));

            $participante = $request->input();

            $participante['cpf'] = str_replace(['.', '-'], '', $participante['cpf'] );
            $participante['rg'] = str_replace(['.', '-'], '', $participante['rg'] );
            $participante['celular'] = str_replace(['(',')', '-', ' '], '', $participante['celular'] );
            $participante['cep'] = str_replace(['(',')', '-', ' '], '', $participante['cep'] );

            $cadastroEvento = InscricaoEvento::where('cpf' , $participante['cpf'] )
                ->where('status_pagamento' , 'CONFIRMED' )->first();

            if($cadastroEvento) 
                throw new \Exception('O(a) CPF ' . $participante['cpf'] . ' já está inscrito(a) nesse evento.');
        
            unset($participante['_token']);   

            if($participante['autorizacao_uso_imagem'] == 'on')
                $participante['autorizacao_uso_imagem'] = 1;
            else    
                $participante['autorizacao_uso_imagem'] = 0;
            
            $participanteSave = InscricaoEvento::Create($participante);

            session()->put('participante',$participanteSave );

            if(!$participanteSave)
                throw new \Exception(('Ocorreu um erro para salvar os dados do participante!'));
            
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
         
            $eventos = Evento::where('data_inicio_inscricao', '<=', now())
            ->where('data_final_inscricao', '>=', now())
            ->get();

            return view('site.eventos.inscricao', compact([ 'eventos', 'errorMessage' ]));        
        
        }

        return view('site.eventos.pagamento', compact([ 'evento' ]));
    }

    public function etapaPagamento(Request $request)
    {
        $retorno = [
            'success' => true,
            'message' => ''
        ];

        try {
            $validade = explode('/', $request->get('validade_cartao'));

            $participante = session()->get('participante');
            $evento = Evento::find($participante->evento_id);

            $cpf = str_replace(['.', '-'], '', $participante->cpf );

            if( $request->get('forma_pagamento') ==  'CREDIT_CARD'){
                $dateTime = DateTime::createFromFormat('m/Y', $request->get('validade_cartao'));

                if (!$dateTime || $dateTime->format('m/Y') !== $request->get('validade_cartao')) 
                    throw new \Exception( 'Informe uma data de validade válida');
    
                if(strlen( $request->get('cvv')) != 3)
                    throw new \Exception( 'Código de segurança inválido');
            }

            $valor =  number_format(  $evento->valor , 2, '.', '.') ;

            if($request->get('parcelamento') > 1)
                $valor = number_format(  $valor + ($valor * 0.0349 + 0.49) , 2, '.', '.');

            //BUSCA CLIENTE 
            $clienteAsaasId = PagamentoService::getCliente($cpf);

            // CASO NÃO EXITA CADASTRA
            if(!$clienteAsaasId){

                $dadosCliente = [
                    'name' => $participante->nome,
                    'cpfCnpj' =>$cpf,
                    'email' =>$participante->email,
                    'mobilePhone' =>$participante->celular,
                    'address' =>$participante->logradouro,
                    'addressNumber' =>$participante->numero,
                    'province' =>$participante->bairro,
                    'postalCode' =>$participante->cep
                ];
    
                $clienteAsaas = PagamentoService::createCliente($dadosCliente);

                if(!isset($clienteAsaas->id)){
                    Log::error($clienteAsaas);
                    throw new \Exception('Ops! Houve um erro interno. Por favor, tente novamente mais tarde. Lamentamos qualquer inconveniente.');
                }
               
                $clienteAsaasId = $clienteAsaas->id;
            }
            
            $dados = [
                'customer' => $clienteAsaasId,
                'billingType' => $request->get('forma_pagamento'),
                'value' => number_format( $valor, 2, '.', '.'),
                'dueDate' => date('Y-m-d'),
                'remoteIp' =>$request->ip(),
                'description' =>$evento->nome
            ];

            if( $request->get('forma_pagamento') ==  'CREDIT_CARD'){

                $dados['installmentCount'] =$request->get('parcelamento');
                $dados['totalValue'] =number_format( $valor, 2, '.', '.');

                $dados['creditCard'] = [
                    "holderName" => $request->get('nome_cartao'),
                    "number" => $request->get('numero_cartao'),
                    "expiryMonth" => $validade[0],
                    "expiryYear" => $validade[1],
                    "ccv" => $request->get('cvv'),
                ];

                $dados['creditCardHolderInfo'] = [
                    "name" => $participante->nome,
                    "email" => $participante->email,
                    "postalCode" =>$participante->cep,
                    "addressNumber" => $participante->cidade . '/'.  $participante->estado. ', '.  $participante->bairro .' '.  $participante->numero .' '.  $participante->logradouro ,
                    "phone" => $participante->celular,
                    "cpfCnpj" => $cpf,
                ];
            }

            $pagamentoRetorno = PagamentoService::sendPaymentRequest($dados);

            if(isset($pagamentoRetorno->errorMessage))
                throw new \Exception( $pagamentoRetorno->errorMessage);
            
            if(!isset($pagamentoRetorno->status) || !isset($pagamentoRetorno->id)){
                Log::error($pagamentoRetorno->errorMessage);
                throw new \Exception('Ops! Houve um erro interno. Por favor, tente novamente mais tarde. Se o problema persistir, entre em contato conosco para obter assistência. Lamentamos qualquer inconveniente.');
            }

            switch($pagamentoRetorno->status){
                case 'CONFIRMED': 
                case 'PENDING': 
                    $codigo = GeradorCodigoService::geraCodigo();

                    $participanteEvento = InscricaoEvento::update($participante->id ,[
                        'codigo' => $codigo,
                        'status_pagamento' =>$pagamentoRetorno->status,
                        'payment_id' => $pagamentoRetorno->id,
                        'customer' => $pagamentoRetorno->customer,
                        'billingType' => $pagamentoRetorno->billingType,
                        'value' => number_format( $evento->valor, 2, '.', '.'),
                        'dueDate' => $pagamentoRetorno->dueDate,
                        'installmentCount' => null,
                        'totalValue' => number_format( $evento->valor, 2, '.', '.'),
                        'remoteIp' =>$request->ip(),
                        'holderName' =>$request->get('nome_cartao'),
                        'creditCardNumber' => isset($pagamentoRetorno->creditCard->creditCardNumber) ? $pagamentoRetorno->creditCard->creditCardNumber : '',
                        'creditCardToken' =>  isset($pagamentoRetorno->creditCard->creditCardToken) ? $pagamentoRetorno->creditCard->creditCardToken : '',
                        'creditCardBrand' => isset($pagamentoRetorno->creditCard->creditCardBrand) ? $pagamentoRetorno->creditCard->creditCardBrand : ''
                    ]);    

                    if(!$participanteEvento)
                        throw new \Exception('Ops! Houve um erro interno. Por favor, tente novamente mais tarde. Se o problema persistir, entre em contato conosco para obter assistência. Lamentamos qualquer inconveniente');
                    
                    if($pagamentoRetorno->status == 'CONFIRMED'){

                        Mail::to($participante['email'])->send(new ConfirmacaoInscricao($participanteEvento));
                        return view('site.inscricao-sucesso');
                    }

                    if($request->get('forma_pagamento') ==  'PIX'){ // capturar QR CODE
                        $pagamentoRetorno = PagamentoService::obetrQrCodePix($pagamentoRetorno->id);
                        return view('site.inscricao-pendente-pix' , compact('pagamentoRetorno'));
                    }
                    elseif($request->get('forma_pagamento') ==  'BOLETO'){ // capturar LINHA DIGITAL
                        $pagamentoId =$pagamentoRetorno->id;
                        $pagamentoRetorno = PagamentoService::obetrLinhaDigitalBoleto($pagamentoRetorno->id);
                        $pagamentoId =  explode('_', $pagamentoId);
                        $pagamentoId = $pagamentoId[1];
                        return view('site.inscricao-pendente-boleto' , compact('pagamentoRetorno', 'pagamentoId'));
                    }

                    break;

                default:
                    throw new \Exception('Desculpe, o pagamento não foi confirmado. Certifique-se de fornecer as informações corretas do pagamento e tente novamente');
                    break;
            }

        } catch (\Exception $e) {    
            Log::error($e);
dd($e->getMessage());
            $retorno = [
                'success' => false,
                'message' =>  $e->getMessage(),
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

    public function getCep() {
        $cep = $_POST['cep'];
        $url = 'https://viacep.com.br/ws/'.$cep.'/json/';
    
        try {
            $resultado = file_get_contents($url);

            if ($resultado === false) 
                throw new Exception("&resultado=0&resultado_txt=erro+ao+buscar+cep");
            
            print_r($resultado);

        } catch (Exception $e) {
            Log::error($e);
            $erro = "&resultado=0&resultado_txt=" . urlencode('Erro ao buscar CEP: ' . $e->getMessage());
            print_r($erro);
        }

        exit;
    }

    public function getrDadosCpf($cpf)
    {
        $response = [
            'success' => true,
            'message' => 'Dados buscados com sucesso'
        ];

        try{
            $participante = InscricaoEvento::where('cpf' , str_replace(['.', '-'], '', $cpf))->first();
    
            if($participante){
                $participante->rg = implode('.', [substr($participante->rg, 0, 2), substr($participante->rg, 2, 3), substr($participante->rg, 5, 3)]) . '-' . substr($participante->rg, 8, 1);
                $participante->celular = '(' . substr($participante->celular, 0, 2) . ')' . substr($participante->celular, 2, 5) . '-' . substr($participante->celular, 7, 4);
                $participante->cep = substr($participante->cep, 0, 5) . '-' . substr($participante->cep, 5, 3);

                $response['dados'] = $participante;
            }else
                throw new Exception("cpf não cadastrado");

        }catch (Exception $e) {
            Log::error($e);
            return [
                'success' => false,
                'message' => 'Ops! Parece que houve um problema ao buscar os horários. Por favor, tente novamente mais tarde.'
            ];
        }

        return $response;
    }
}
