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
use App\Mail\ConfirmacaoInscricao;
use Illuminate\Support\Facades\Log;


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

            $atletaCampeonato = AtletaXcampeonato::join('atletas', 'atletas.id', 'atleta_x_campeonato.atleta_id')
                ->where('atletas.cpf' , $atleta['cpf'] )
                ->where('atleta_x_campeonato.categoria_id' , $atleta['categorias'] )->first();

            if($atletaCampeonato) 
                throw new \Exception('O(a) atleta com o CPF ' . $atleta['cpf'] . ' já está inscrito(a) no campeonato e categoria selecionados.');

            session()->put('atleta', $request->input());

            unset($atleta['_token']);        

            $atletaSave = Atleta::firstOrCreate(['cpf' =>  $atleta['cpf']], $atleta);

            if(!$atletaSave)
                throw new \Exception(('Ocorreu um erro para salvar os dados do atleta!'));
            
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
         
            $campeonatos = Campeonato::where('data_inicio_inscricao', '<=', now())
            ->where('data_final_inscricao', '>=', now())
            ->get();

            return view('site.inscricao', compact([ 'campeonatos', 'errorMessage' ]));        
        
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

            //BUSCA CLIENTE 
            $clienteAsaasId = PagamentoService::getCliente($cpf);

            // CASO NÃO EXITA CADASTRA
            if(!$clienteAsaasId){

                $dadosCliente = [
                    'name' => $atleta['nome'],
                    'cpfCnpj' =>$cpf,
                    'email' =>$atleta['email'],
                    'mobilePhone' =>$atleta['celular'],
                    'address' =>$atleta['logradouro'],
                    'addressNumber' =>$atleta['numero'],
                    'province' =>$atleta['bairro'],
                    'postalCode' =>$atleta['cep']
                ];
    
                $clienteAsaas = PagamentoService::createCliente($dadosCliente);

                if(!isset($clienteAsaas->id))
                    throw new \Exception('Ops! Houve um erro interno. Por favor, tente novamente mais tarde. Se o problema persistir, entre em contato conosco para obter assistência. Lamentamos qualquer inconveniente.');
               
                $clienteAsaasId = $clienteAsaas->id;
            }
            
            $dados = [
                'customer' => $clienteAsaasId,
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
            
            if(!isset($pagamentoRetorno->status))
                throw new \Exception('Ops! Houve um erro interno. Por favor, tente novamente mais tarde. Se o problema persistir, entre em contato conosco para obter assistência. Lamentamos qualquer inconveniente.');
            
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

                    if(!$atletaXCampeonato)
                        throw new \Exception('Ops! Houve um erro interno. Por favor, tente novamente mais tarde. Se o problema persistir, entre em contato conosco para obter assistência. Lamentamos qualquer inconveniente');
                    
                    return view('site.inscricao-sucesso');

                    break;

                default:
                    throw new \Exception('Desculpe, o pagamento não foi confirmado. Certifique-se de fornecer as informações corretas do pagamento e tente novamente');
                    break;
            }

        } catch (\Exception $e) {                
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
            $erro = "&resultado=0&resultado_txt=" . urlencode('Erro ao buscar CEP: ' . $e->getMessage());
            print_r($erro);
        }

        exit;
    }

    public function teste()
    {
        $dadosEmail =[
            'nome' => 'Larissa Milher',
            'email' => 'larissamilher@gmail.com'
        ];

        // return view('emails.confirmacao-inscricao', compact('dadosEmail'));

        $e = Mail::to($dadosEmail['email'])->send(new ConfirmacaoInscricao($dadosEmail));

        dd($e);
    }
}
