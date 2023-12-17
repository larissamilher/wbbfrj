<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campeonato;
use App\Models\CategoriaCampeonato;
use App\Services\PagamentoService;
use App\Models\Atleta;
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
                throw('Ocorreu um erro para salvar os dados do atleta!');

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

            // dd( $dados);
            $response = PagamentoService::sendPaymentRequest($dados);


            if(isset($response->errors[0]->code)){

                $retorno = [
                    'success' => false,
                    'message' => $response->errors[0]->description,
                    'code' =>$response->errors[0]->code,
                    'cartao' => [
                        "nome" => $request->get('nome_cartao'),
                        "numero" => $request->get('numero_cartao'),
                        "validade" => $request->get('validade_cartao'),
                        "ccv" => $request->get('cvv'),
                    ],
                ];
                
                return view('site.pagamento', compact([ 'campeonato','retorno' ]));
                
                dd($response->errors[0]);
            }

            dd($response->errors[0]->code);

            switch($response->status){
                case 'CONFIRMED': 

                    break;

                case 'PENDING': 

                    break;

                case 'REFUSED': 

                    break;

            }

        } catch (\Exception $e) {
            $errorMessage = $e;
            $response = (object)['errorMessage' => $errorMessage];
        }

    }

    private function prepareRequestData($dadosPagamento, $atleta)
    {
        $validade = explode('/', $request->get('validade'));

        $dados = [
            'customer' => env('customer'),
            'billingType' => 'CREDIT_CARD',
            'value' => $request->get('valor'),
            'dueDate' => date('Y-m-d'),
            'installmentCount' => $request->get('parcelas'),
            'totalValue' =>  $request->get('valor'),
            'remoteIp' =>$request->ip(),
            'creditCard' => [
                "holderName" => $request->get('nome'),
                "number" => $request->get('numero'),
                "expiryMonth" => $validade[0],
                "expiryYear" => "20" . $validade[1],
                "ccv" => $request->get('cod_seguranca'),
            ],
            'creditCardHolderInfo' => [
                "name" => $request->get('nome'),
                "email" => $request->get('email'),
                "postalCode" => $request->get('cep'),
                "addressNumber" => $request->get('endereco'),
                "phone" => $request->get('telefone'),
                "cpfCnpj" => $request->get('cpf'),
            ],
        ];

        return $dados;
    }

}
