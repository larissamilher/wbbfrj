<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\Campeonato;

class PagamentoService
{
    public static function sendPaymentRequest(array $requestData)
    {
        try {
            $client =  new \GuzzleHttp\Client();

            $response = $client->request('POST', env('URL_ASAAS') . '/payments', [
                'body' => json_encode($requestData),
                'headers' => [
                    'accept' => 'application/json',
                    'access_token' => env('ASAAS'),
                    'content-type' => 'application/json',
                ],
            ]);

            $response = json_decode($response->getBody()->getContents());

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $errorBody = json_decode($response->getBody());
            $errorMessage = self::extractErrorMessage($errorBody);
            $response->errorMessage = $errorMessage;
        } catch (\Exception $e) {
            $errorMessage = 'Ocorreu um erro inesperado, tente novamente mais tarde.';
            $response = (object)['errorMessage' => $errorMessage];
        }

        return $response;
    }

    public static function getDataisPayment($paymentId, $endpoint)
    {
        try {

            $client =  new \GuzzleHttp\Client();

            $response = $client->request('GET',  config('enums.asaas.api_url') . '/payments/'.$paymentId.'/'.$endpoint, [
                'headers' => [
                    'accept' => 'application/json',
                    'access_token' => env('ASAAS'),
                ],
                ]);
            $response = json_decode($response->getBody()->getContents());

            if(isset($response->encodedImage))                 
                $retorno['imagem'] = base64_decode($response->encodedImage);

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $errorBody = json_decode($response->getBody());
            $errorMessage = self::extractErrorMessage($errorBody);
            $response->errorMessage = $errorMessage;
        } catch (\Exception $e) {
            $errorMessage = 'Ocorreu um erro inesperado, tente novamente mais tarde.';
            $response = (object)['errorMessage' => $errorMessage];
        }
    
        return $response;
    }

    public static function extractErrorMessage($errorBody)
    {
        if (isset($errorBody->errors) && is_array($errorBody->errors) && !empty($errorBody->errors)) {
            $errorMessage = '';
            foreach ($errorBody->errors as $error) {
                $errorMessage .= $error->description . ' ';
            }
        } else 
            $errorMessage = 'Ocorreu um erro inesperado, tente novamente mais tarde.';
        
        return $errorMessage;
    }

    public static function getCliente($cpf)
    {
        $client =  new \GuzzleHttp\Client();

        $response = $client->request('GET', env('URL_ASAAS') . '/customers?cpfCnpj='.$cpf, [
            'headers' => [
                'accept' => 'application/json',
                'access_token' => env('ASAAS')
            ],
        ]);

        $response = json_decode($response->getBody()->getContents());

        if(isset($response->data[0]->id))
            return $response->data[0]->id;

        return null;

    }

    public static function createCliente($requestData)
    {

        $client =  new \GuzzleHttp\Client();

        $response = $client->request('POST', env('URL_ASAAS') . '/customers', [
            'body' => json_encode($requestData),
            'headers' => [
                'accept' => 'application/json',
                'access_token' => env('ASAAS'),
                'content-type' => 'application/json',
            ],
        ]);

        $response = json_decode($response->getBody()->getContents());

        return $response;

    }

    public static function obetrQrCodePix($pagamentoId)
    {

        $client =  new \GuzzleHttp\Client();

        $response = $client->request('GET', env('URL_ASAAS') . '/payments/'.$pagamentoId.'/pixQrCode', [
            'headers' => [
                'accept' => 'application/json',
                'access_token' => env('ASAAS'),
                'content-type' => 'application/json',
            ],
        ]);

        $response = json_decode($response->getBody()->getContents());

        return $response;

    }

    public static function obetrLinhaDigitalBoleto($pagamentoId)
    {

        $client =  new \GuzzleHttp\Client();

        $response = $client->request('GET', env('URL_ASAAS') . '/payments/'.$pagamentoId .'/identificationField', [
            'headers' => [
                'accept' => 'application/json',
                'access_token' => env('ASAAS'),
                'content-type' => 'application/json',
            ],
        ]);

        $response = json_decode($response->getBody()->getContents());

        return $response;

    }

    public static function obterSatusPagamento($pagamentoId)
    {

        $client =  new \GuzzleHttp\Client();

        $response = $client->request('GET', env('URL_ASAAS') . '/payments/'.$pagamentoId .'/status', [
            'headers' => [
                'accept' => 'application/json',
                'access_token' => env('ASAAS'),
                'content-type' => 'application/json',
            ],
        ]);

        $response = json_decode($response->getBody()->getContents());

        return $response;

    }

}