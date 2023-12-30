<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campeonato;
use App\Models\CategoriaCampeonato;
use App\Services\PagamentoService;
use App\Models\Atleta;
use App\Models\Filiado;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contato;
use Illuminate\Support\Facades\Log;
use PDF;
use Illuminate\Support\Facades\View;
use PhpOffice\PhpSpreadsheet\Exception;
use App\Models\Filiacao;
use App\Models\InscricaoEvento;
use App\Mail\ConfirmacaoInscricaoFiliacao;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Services\GeradorCodigoService;
use DateTime;

class FiliadosController extends Controller
{
    public function cadastro(){
        
        $filiacoes = Filiacao::where('data_inicio_inscricao', '<=', now())
            ->where('data_final_inscricao', '>=', now())
            ->get();

        return view('site.filiacao.cadastro', compact([ 'filiacoes']));        
    }

    public function primeiraEtapaInscricao(Request $request)
    {
        try {

            $filiado = $request->input();
           
            $filiado['cpf'] = str_replace(['.', '-'], '', $filiado['cpf'] );
            $filiado['rg'] = str_replace(['.', '-'], '', $filiado['rg'] );
            $filiado['celular'] = str_replace(['(',')', '-', ' '], '', $filiado['celular'] );
            $filiado['cep'] = str_replace(['(',')', '-', ' '], '', $filiado['cep'] );

            if($filiado['termos_atleta'] == 'on')
                $filiado['termos_atleta'] = 1;
            else
                $filiado['termos_atleta'] = 0;

            if($filiado['autorizacao_uso_imagem'] == 'on')
                $filiado['autorizacao_uso_imagem'] = 1;
            else
                $filiado['autorizacao_uso_imagem'] = 0;

            $atleta = Atleta::updateOrCreate(['cpf'=>$filiado['cpf']],
            [
                'nome'=> $request->get('nome'),
                'rg'=> $filiado['rg'],
                'data_nascimento'=> $request->get("data_nascimento"),
                'celular'=> $filiado['celular'] ,
                'email'=> $request->get('email'),
                'cep'=> $filiado['cep'],
                'estado'=> $request->get('estado'),
                'cidade'=> $request->get('cidade'),
                'logradouro'=> $request->get('logradouro'),
                'bairro'=> $request->get('bairro'),
                'numero'=> $request->get('numero'),
                'academia_coach'=> $request->get('academia_coach'),
                'autorizacao_uso_imagem'=> $filiado['autorizacao_uso_imagem'],
                'termos_atleta'=>  $filiado['termos_atleta'],
            ]);

            unset($filiado['_token']);   

            $filiacao = Filiacao::find($filiado['filiacao_id']);

            $filiadoSave = Filiado::updateOrCreate(['atleta_id'=> $atleta->id],[
                'atleta_id'=> $atleta->id,
                'filiacao_id'=> $filiado['filiacao_id'],
                'status'=> 'PENDENTE'
            ]);
            session()->put('filiado',$filiadoSave );

            if(!$filiadoSave)
                throw new \Exception(('Ocorreu um erro para salvar os dados do filiado!'));
            
        } catch (\Exception $e) {

            $filiacoes = Filiacao::where('data_inicio_inscricao', '<=', now())
            ->where('data_final_inscricao', '>=', now())
            ->get();

            $errorMessage = $e->getMessage();
            return view('site.filiacao.cadastro', compact('errorMessage','filiacoes'));    
        }

        return view('site.filiacao.pagamento', compact([ 'filiacao' ]));
    }

    public function etapaPagamento(Request $request)
    {
        $retorno = [
            'success' => true,
            'message' => ''
        ];

        try {
            $validade = explode('/', $request->get('validade_cartao'));

            $participante = session()->get('filiado');
            $filiacao = Filiacao::find($participante->filiacao_id);

            $atleta = Atleta::find( $participante->atleta_id);

            $cpf = str_replace(['.', '-'], '', $atleta->cpf );

            if( $request->get('forma_pagamento') ==  'CREDIT_CARD'){
                $dateTime = DateTime::createFromFormat('m/Y', $request->get('validade_cartao'));

                if (!$dateTime || $dateTime->format('m/Y') !== $request->get('validade_cartao')) 
                    throw new \Exception( 'Informe uma data de validade válida');
    
                if(strlen( $request->get('cvv')) != 3)
                    throw new \Exception( 'Código de segurança inválido');
            }

            $valor =  number_format(  $filiacao->valor , 2, '.', '.') ;

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
                'description' =>$filiacao->nome
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
                    "name" => $atleta->nome,
                    "email" => $atleta->email,
                    "postalCode" =>$atleta->cep,
                    "addressNumber" => $atleta->cidade . '/'.  $atleta->estado. ', '.  $atleta->bairro .' '.  $atleta->numero .' '.  $atleta->logradouro ,
                    "phone" => $atleta->celular,
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

                    $participanteEvento = Filiado::find($participante->id);

                    if ($participanteEvento) {

                        $participanteEvento->update([
                            'validade_filiacao' =>$filiacao->validade,
                            'codigo' => $codigo,
                            'status' =>$pagamentoRetorno->status,
                            'status_pagamento' =>$pagamentoRetorno->status,
                            'payment_id' => $pagamentoRetorno->id,
                            'customer' => $pagamentoRetorno->customer,
                            'billingType' => $pagamentoRetorno->billingType,
                            'value' => number_format( $filiacao->valor, 2, '.', '.'),
                            'dueDate' => $pagamentoRetorno->dueDate,
                            'installmentCount' => null,
                            'totalValue' => number_format( $filiacao->valor, 2, '.', '.'),
                            'remoteIp' =>$request->ip(),
                            'holderName' =>$request->get('nome_cartao'),
                            'creditCardNumber' => isset($pagamentoRetorno->creditCard->creditCardNumber) ? $pagamentoRetorno->creditCard->creditCardNumber : '',
                            'creditCardToken' =>  isset($pagamentoRetorno->creditCard->creditCardToken) ? $pagamentoRetorno->creditCard->creditCardToken : '',
                            'creditCardBrand' => isset($pagamentoRetorno->creditCard->creditCardBrand) ? $pagamentoRetorno->creditCard->creditCardBrand : ''
                        ]);    
                    }

                    if(!$participanteEvento)
                        throw new \Exception('Ops! Houve um erro interno. Por favor, tente novamente mais tarde. Se o problema persistir, entre em contato conosco para obter assistência. Lamentamos qualquer inconveniente');
                    
                    if($pagamentoRetorno->status == 'CONFIRMED'){

                        Mail::to($atleta->email)->send(new ConfirmacaoInscricaoFiliacao([
                            'nome' =>$atleta->nome,
                            'codigo' => $codigo
                        ]));
                        
                        return view('site.filiacao.inscricao-sucesso');
                    }

                    if($request->get('forma_pagamento') ==  'PIX'){ // capturar QR CODE
                        $pagamentoRetorno = PagamentoService::obetrQrCodePix($pagamentoRetorno->id);
                        return view('site.filiacao.inscricao-pendente-pix' , compact('pagamentoRetorno'));
                    }
                    elseif($request->get('forma_pagamento') ==  'BOLETO'){ // capturar LINHA DIGITAL
                        $pagamentoId =$pagamentoRetorno->id;
                        $pagamentoRetorno = PagamentoService::obetrLinhaDigitalBoleto($pagamentoRetorno->id);
                        $pagamentoId =  explode('_', $pagamentoId);
                        $pagamentoId = $pagamentoId[1];
                        return view('site.filiacao.inscricao-pendente-boleto' , compact('pagamentoRetorno', 'pagamentoId'));
                    }

                    break;

                default:
                    throw new \Exception('Desculpe, o pagamento não foi confirmado. Certifique-se de fornecer as informações corretas do pagamento e tente novamente');
                    break;
            }

        } catch (\Exception $e) {    
            Log::error($e);

            $filiacao = Filiacao::find($request->input('filiacao_id'));

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
            return view('site.filiacao.pagamento', compact([ 'filiacao','retorno' ]));
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
            $participante = Atleta::where('cpf' , str_replace(['.', '-'], '', $cpf))->first();
    
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
