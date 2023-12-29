@extends('layouts.email')

@section('content').

    <p style="margin:0;margin-bottom:20px;color:#000;font-family:Georgia,Arial,sans-serif;font-size:32px;font-weight:normal;line-height:40px;padding:0;text-align:left">
        <strong>olá, {{$dadosEmail->nome}}!</strong>
    </p>

    <p style="margin:0;margin-bottom:20px;color:#000;font-family:Arial,sans-serif;font-size:22px;font-weight:normal;line-height:32px;padding:0;text-align:left">
        <strong>Parabéns </strong> pela sua compra no nosso evento!
    </p>

    <table align="center" style="width:100%">
        <tbody>
            <tr>
                <td>
                    <p style="margin:0;margin-bottom:0;color:#121212;font-family:Arial,sans-serif;font-size:16px;font-weight:normal;line-height:24px;padding:0;text-align:left">
                        Seu código de compra é: <strong>{{$dadosEmail->codigo}}</strong> 
                        <br><br>
                        Anexado a este e-mail está o seu ingresso digital.
                        Por favor, apresente-o no dia do evento para garantir sua entrada. 
                        <br> <br>

                        Se optou pela solidariedade, não esqueça de trazer, no dia do evento, 
                        1 kg de alimento não perecível ou um brinquedo. 
                        <br>  
                        Sua generosidade é fundamental para fazer a diferença!
                        <br><br>
                        Estamos ansiosos para recebê-lo!
                        <br> <br>                                               
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

@endsection
