<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\Campeonato;
use App\Models\InscricaoCampeonato;

class PagamentoService
{
    public function paymentConfirm($post)
    {
        $user = session()->get('ficheAtleta');

        $campeonato = Campeonato::find($user['campeonato']);
        
        $clienteEmail = $user['email'];
        
        if (!isset($post['numero_cartao']) || !$post['numero_cartao']) {
            return response()->json(array(
                'success' => false,
                'message' => 'O campo Número do cartão é obrigatório.'
            ));
        }
        if (!isset($post['validade_cartao']) || !$post['validade_cartao']) {
            return response()->json(array(
                'success' => false,
                'message' => 'O campo Validade é obrigatório.'
            ));
        }
        if (!isset($post['nome_cartao']) || !$post['nome_cartao']) {
            return response()->json(array(
                'success' => false,
                'message' => 'O campo Nome completo é obrigatório.'
            ));
        }
        if (!isset($post['cvv']) || !$post['cvv']) {
            return response()->json(array(
                'success' => false,
                'message' => 'O campo CVV é obrigatório.'
            ));
        }

        // // iniciando pedido
        // $pedidoVenda = new InscricaoCampeonato();
        // $pedidoVenda->id_cliente = $titular->id;
        // $pedidoVenda->nm_referencia = 'Tentativa de compra por ' . $titular->nome;
        // $pedidoVenda->paciente_nome = $paciente_nome;
        // $pedidoVenda->paciente_data_nascimento = $paciente_data_nascimento;
        // $pedidoVenda->paciente_cpf = $paciente_cpf;
        // $pedidoVenda->paciente_rg = $paciente_rg;
        // $pedidoVenda->paciente_nome_da_mae = $paciente_nome_da_mae;
        // $pedidoVenda->paciente_telefone = $paciente_telefone;

        // $pedidoVenda->paciente_cep = $paciente_cep;
        // $pedidoVenda->paciente_estado = $paciente_estado;
        // $pedidoVenda->paciente_cidade = $paciente_cidade;
        // $pedidoVenda->paciente_bairro = $paciente_bairro;
        // $pedidoVenda->paciente_rua = $paciente_rua;
        // $pedidoVenda->paciente_numero = $paciente_numero;
        // $pedidoVenda->paciente_complemento = $paciente_complemento;

        // $pedidoVenda->parcelas = 12;

        // $pedidoVenda->id_status_pedido_venda = 1; // Aguardando Pagamento
        // $pedidoVenda->status = 'Aguardando Pagamento';
        $total = number_format($campeonato->valor, 2, '.', '');
        // $pedidoVenda->total = $total;
        // $pedidoVenda->save();

        if ($total > 0) {
            $parts = explode('/', $post['validade_cartao']);
            $mes = trim($parts[0]);
            $ano = trim($parts[1]);
            if (strlen($ano) == 4) 
                $ano = substr($ano, 2);
            
            $post['cvv'] = preg_replace("/[^0-9]/", "", $post['cvv']);
            $amount = preg_replace("/[^0-9]/", "", $total);
            $numeroCartao = preg_replace("/[^0-9]/", "", $post['numero_cartao']);
            $elo_bin = implode("|", array('636368', '438935', '504175', '451416', '636297', '506699', '509048', '509067', '509049', '509069', '509050', '09074', '509068', '509040', '509045', '509051', '509046', '509066', '509047', '509042', '509052', '509043', '509064', '509040'));
            $expressoes = array(
                "Elo"           => "/^((" . $elo_bin . "[0-9]{10})|(36297[0-9]{11})|(5067|4576|4011[0-9]{12}))/",
                "Discover"      => "/^((6011[0-9]{12})|(622[0-9]{13})|(64|65[0-9]{14}))/",
                "Diners"        => "/^((301|305[0-9]{11,13})|(36|38[0-9]{12,14}))/",
                "Amex"          => "/^((34|37[0-9]{13}))/",
                "Hipercard"     => "/^((38|60[0-9]{11,14,17}))/",
                "Aura"          => "/^((50[0-9]{14}))/",
                "JCB"           => "/^((35[0-9]{14}))/",
                "Master"        => "/^((5[0-9]{15}))/",
                "Visa"          => "/^((4[0-9]{12,15}))/"
            );
            $bandeira = 'Visa';
            foreach ($expressoes as $bnd => $expressao) {
                if (preg_match($expressao, $numeroCartao)) 
                    $bandeira = $bnd;                
            }

            dd($bandeira, $numeroCartao, $amount );


            $data = [
                'items' => [
                    [
                        'id' => '18',
                        'description' => 'Item Um',
                        'quantity' => '1',
                        'amount' => '1.15',
                        'weight' => '45',
                        'shippingCost' => '3.5',
                        'width' => '50',
                        'height' => '45',
                        'length' => '60',
                    ]
                ],
                'shipping' => [
                    'address' => [
                        'postalCode' => '06410030',
                        'street' => 'Rua Leonardo Arruda',
                        'number' => '12',
                        'district' => 'Jardim dos Camargos',
                        'city' => 'Barueri',
                        'state' => 'SP',
                        'country' => 'BRA',
                    ],
                    'type' => 2,
                    'cost' => 30.4,
                ],
                'sender' => [
                    'email' => 'sender@gmail.com',
                    'name' => 'Isaque de Souza Barbosa',
                    'documents' => [
                        [
                            'number' => '01234567890',
                            'type' => 'CPF'
                        ]
                    ],
                    'phone' => [
                        'number' => '985445522',
                        'areaCode' => '11',
                    ],
                    'bornDate' => '1988-03-21',
                ]
            ];

            $checkout = PagSeguro::checkout()->createFromArray($data);

            $checkout = PagSeguro::checkout()->createFromArray($data);
            $credentials = PagSeguro::credentials()->get();
            $information = $checkout->send($credentials); // Retorna um objeto de laravel\pagseguro\Checkout\Information\Information
            if ($information) {
                print_r($information->getCode());
                print_r($information->getDate());
                print_r($information->getLink());
            }

            $paymentResponse = $this->cieloPayment->makePayment(
                amount: intval($amount),
                cardNumber: $numeroCartao,
                expirationDate: $mes . "/20" . $ano,
                cvv: $post['card_cvv'],
                userName: $post['card_holder'],
                orderId: $pedidoVenda->id,
                brand: $bandeira
            );

            $pedidoVenda->save();
            $paymentFormatted = (array) $paymentResponse->Payment;

            $nsu = array_key_exists('ProofOfSale', $paymentFormatted) ? $paymentFormatted['ProofOfSale'] : null;
            $paymentId = $paymentFormatted['PaymentId'];
            $tid = $paymentFormatted['Tid'];
            $status = $paymentFormatted['Status'];
            $pedidoVenda->capture = $paymentFormatted['Capture'];

            $pedidoVenda->cielo_payment_id = $paymentId;
            $pedidoVenda->cielo_tid = $tid;
            $pedidoVenda->cielo_nsu = $nsu;

            switch($status){
                case 1:
                case 2:
                case 4: 
                case 6:   
                    $pedidoVenda->status = 'Pagamento Efetuado';
                    $pedidoVenda->id_status_pedido_venda = 2;// Pagamento Efetuado
                    break; 

                case 0:
                    $pedidoVenda->status = 'Aguardando atualização de status';
                    $pedidoVenda->id_status_pedido_venda = 0;
                    break;

                case 3:
                    $pedidoVenda->status = 'Pagamento negado por Autorizador';
                    $pedidoVenda->id_status_pedido_venda = 3;
                    break;

                case 10:
                    $pedidoVenda->status = 'Pagamento cancelado';
                    $pedidoVenda->id_status_pedido_venda = 10;
                    break;

                case 11:
                    $pedidoVenda->status = 'Pagamento cancelado após 23h59 do dia de autorização';
                    $pedidoVenda->id_status_pedido_venda = 11;
                    break;

                case 12:
                    $pedidoVenda->status = 'Aguardando retorno da instituição financeira';
                    $pedidoVenda->id_status_pedido_venda = 12;
                    break;

                case 13:
                    $pedidoVenda->status = 'Pagamento cancelado por falha no processamento ou por ação do Antifraude';
                    $pedidoVenda->id_status_pedido_venda = 13;
                    break;

                case 20:
                    $pedidoVenda->status = 'Recorrência agendada';
                    $pedidoVenda->id_status_pedido_venda = 20;
                    break;

            }

            $sendEmail = array(
                'pedido'   => $pedidoVenda
            );

            $compra = Compras::where('usuario_id',  $user->usuario_id )->first();

            if(!$compra)
                $compra = new Compras();

            $compra->usuario_id = $user->usuario_id;
            $compra->plano_id =$plano->id;
            $compra->pedido_vendas_id =$pedidoVenda->id;
            $compra->save();
                    
            // $pedidoVenda->save();

            // $email = 'larissamilher@gmail.com';

            // Mail::to($email)->send(
            //     new AvisoCompra($pedidoVenda, $clienteEmail, $plano)
            // );

            if (!in_array($status, array(1, 2, 4, 6)))
                return response()->json(["status" => false, "message" => 'Houve um erro ao processar sua compra. Verifique os dados do seu cartão de crédito ou entre em contato conosco.']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Compra realizada com sucesso!'
        ]);
    }
}