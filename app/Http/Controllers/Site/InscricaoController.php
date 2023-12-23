<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campeonato;
use App\Models\SubCategoriaCampeonato;
use App\Models\SubCategoria;
use App\Models\Categoria;
use App\Services\PagamentoService;
use App\Services\GeradorCodigoService;
use App\Models\Atleta;
use App\Models\AtletaXCampeonato;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmacaoInscricao;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Exception;

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

            $categorias = Categoria::Join('sub_categorias', 'sub_categorias.categoria_id', 'categorias.id')
            ->Join('sub_categorias_campeonato', 'sub_categorias_campeonato.sub_categoria_id', 'sub_categorias.id')
            ->where('sub_categorias_campeonato.campeonato_id', $campeonatoId)
            ->select('categorias.*')
            ->groupBy('categorias.id')
            ->get();
    
            $response['dados'] = $categorias;

        }catch (Exception $e) {
            Log::error($e);
            return [
                'success' => false,
                'message' => 'Ops! Parece que houve um problema. Por favor, tente novamente mais tarde.'
            ];
        }

        return $response;
    }

    public function getSubCategoriasCampeonato($categoriaId)
    {
        $response = [
            'success' => true,
            'message' => 'Dados buscados com sucesso'
        ];

        try{
            $subcategorias = SubCategoria::where('categoria_id', $categoriaId)
            ->get();
    
            $response['dados'] = $subcategorias;

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

            $atletaCampeonatoSubCategoria = AtletaXcampeonato::join('atletas', 'atletas.id', 'atleta_x_campeonato.atleta_id')
                ->where('atletas.cpf' , $atleta['cpf'] )
                ->where('atleta_x_campeonato.sub_categoria_id' , $atleta['sub_categoria_id'] )
                ->where('atleta_x_campeonato.status_pagamento' , 'CONFIRMED' )->first();

            if($atletaCampeonatoSubCategoria) 
                throw new \Exception('O(a) atleta com o CPF ' . $atleta['cpf'] . ' já está inscrito(a) no campeonato e na subcategoria escolhidos.');

            $atletaCampeonato = AtletaXcampeonato::join('atletas', 'atletas.id', 'atleta_x_campeonato.atleta_id')
                ->where('atletas.cpf' , $atleta['cpf'] )
                ->where('atleta_x_campeonato.campeonato_id' , $atleta['campeonato'] )->first();

            if($atletaCampeonato)
                $campeonato->valor = $campeonato->valor_dobra;
            
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
            $validade = explode('/', $request->get('validade_cartao'));

            $atleta = session()->get('atleta');
            $cpf = str_replace(['.', '-'], '', $atleta['cpf'] );

            $campeonato = Campeonato::find($atleta['campeonato']);

            $valor =  number_format(  $campeonato->valor , 2, '.', '.') ;

            $atletaCampeonato = AtletaXcampeonato::join('atletas', 'atletas.id', 'atleta_x_campeonato.atleta_id')
            ->where('atletas.cpf' , $cpf )
            ->where('atleta_x_campeonato.campeonato_id' , $atleta['campeonato'] )->first();

            if($atletaCampeonato)
                $valor = number_format(  $campeonato->valor_dobra , 2, '.', '.');

            if($request->get('parcelamento') > 1)
                $valor = number_format(  $valor + ($valor * 0.0349 + 0.49) , 2, '.', '.');

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
                'description' =>$campeonato->nome
            ];

            if( $request->get('forma_pagamento') ==  'CREDIT_CARD'){

                $dados['installmentCount'] =$request->get('parcelamento');
                $dados['totalValue'] =number_format( $valor, 2, '.', '.');

                $dados['creditCard'] = [
                    "holderName" => $request->get('nome_cartao'),
                    "number" => $request->get('numero_cartao'),
                    "expiryMonth" => $validade[0],
                    "expiryYear" => "20" . $validade[1],
                    "ccv" => $request->get('cvv'),
                ];

                $dados['creditCardHolderInfo'] = [
                    "name" => $atleta['nome'],
                    "email" => $atleta['email'],
                    "postalCode" => $atleta['cep'],
                    "addressNumber" => $atleta['cidade'] . '/'.  $atleta['estado']. ', '.  $atleta['bairro'] .' '.  $atleta['numero'] .' '.  $atleta['logradouro'] ,
                    "phone" => $atleta['celular'],
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
                    $atletaId = Atleta::where('cpf', $cpf )->pluck('id')->first();
                    $codigo = GeradorCodigoService::geraCodigo();

                    $atletaXCampeonato = AtletaXCampeonato::create([
                        'codigo' => $codigo,
                        'campeonato_id' => $atleta['campeonato'],
                        'sub_categoria_id' => $atleta['sub_categoria_id'],
                        'atleta_id' => $atletaId,
                        'cupom_id' =>null,
                        'status_pagamento' =>$pagamentoRetorno->status,
                        'payment_id' => $pagamentoRetorno->id,
                        'customer' => $pagamentoRetorno->customer,
                        'billingType' => $pagamentoRetorno->billingType,
                        'value' => number_format( $campeonato->valor, 2, '.', '.'),
                        'dueDate' => $pagamentoRetorno->dueDate,
                        'installmentCount' => null,
                        'totalValue' => number_format( $campeonato->valor, 2, '.', '.'),
                        'remoteIp' =>$request->ip(),
                        'holderName' =>$request->get('nome_cartao'),
                        'creditCardNumber' => isset($pagamentoRetorno->creditCard->creditCardNumber) ? $pagamentoRetorno->creditCard->creditCardNumber : '',
                        'creditCardToken' =>  isset($pagamentoRetorno->creditCard->creditCardToken) ? $pagamentoRetorno->creditCard->creditCardToken : '',
                        'creditCardBrand' => isset($pagamentoRetorno->creditCard->creditCardBrand) ? $pagamentoRetorno->creditCard->creditCardBrand : ''
                    ]);    

                    if(!$atletaXCampeonato)
                        throw new \Exception('Ops! Houve um erro interno. Por favor, tente novamente mais tarde. Se o problema persistir, entre em contato conosco para obter assistência. Lamentamos qualquer inconveniente');
                    
                    $atleta['categoria'] = Categoria::find($atleta['categorias']);

                    $subCategoria = SubCategoria::find($atleta['sub_categoria_id']);

                    $atleta['codigo'] =  $codigo;
                    $atleta['subcategoria'] = $subCategoria->nome;

                    
                    if($pagamentoRetorno->status == 'CONFIRMED'){

                        Mail::to($atleta['email'])->send(new ConfirmacaoInscricao($atleta));
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
            $atleta = Atleta::where('cpf' , str_replace(['.', '-'], '', $cpf))->first();
    
            if($atleta){
                $atleta->rg = implode('.', [substr($atleta->rg, 0, 2), substr($atleta->rg, 2, 3), substr($atleta->rg, 5, 3)]) . '-' . substr($atleta->rg, 8, 1);
                $atleta->celular = '(' . substr($atleta->celular, 0, 2) . ')' . substr($atleta->celular, 2, 5) . '-' . substr($atleta->celular, 7, 4);
                $atleta->cep = substr($atleta->cep, 0, 5) . '-' . substr($atleta->cep, 5, 3);

                $response['dados'] = $atleta;
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
