<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\Campeonato;
use App\Models\InscricaoCampeonato;

class PagamentoService
{
    public static function sendPaymentRequest(array $requestData)
    {
        try {
            $client =  new \GuzzleHttp\Client();

            // $response = $client->request('POST', config('enums.asaas.api_url') . '/payments', [
            //     'body' => json_encode($requestData),
            //     'headers' => [
            //         'accept' => 'application/json',
            //         'access_token' => env('ASAAS'),
            //         'content-type' => 'application/json',
            //     ],
            // ]);

            // $response = json_decode($response->getBody()->getContents());

            $response = session()->get('pagamento');

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

}