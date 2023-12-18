<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\AtletaXCampeonato;

class GeradorCodigoService
{
    public static function geraCodigo()
    {
        $codigo = GeradorCodigoService::numeroSeteDigitosComAno();
        $verificaRepeticaoCodigo = true;

        // nao deixa repetir codigo
        while ($verificaRepeticaoCodigo) {
            $atletaCampeonato = AtletaXCampeonato::where('codigo', 'like', '%' . $codigo)->first();
            if (is_null($atletaCampeonato))
                $verificaRepeticaoCodigo = false;
            else 
                $codigo = GeradorCodigoService::numeroSeteDigitosComAno();            
        }
        return $codigo;
    }

    public static function numeroSeteDigitosComAno()
    {
        return GeradorCodigoService::numeroSeteDigitos(rand(0, 9999999)) . '/' . date('Y');
    }

    public static function numeroSeteDigitos($input)
    {
        return str_pad($input, 7, '0', STR_PAD_LEFT);
    }
}