@extends('layouts.email')

@section('content').

    <p style="margin:0;margin-bottom:20px;color:#000;font-family:Georgia,Arial,sans-serif;font-size:32px;font-weight:normal;line-height:40px;padding:0;text-align:left">
        <strong>olá, {{$dadosEmail['nome']}}!</strong>
    </p>

    <p style="margin:0;margin-bottom:20px;color:#000;font-family:Arial,sans-serif;font-size:22px;font-weight:normal;line-height:32px;padding:0;text-align:left">
        <strong>Parabéns </strong> pela sua inscrição no nosso evento! Estamos empolgados por tê-lo(a) conosco.
    </p>

    <table align="center" style="width:100%">
        <tbody>
            <tr>
                <td>
                    <p style="margin:0;margin-bottom:0;color:#121212;font-family:Arial,sans-serif;font-size:16px;font-weight:normal;line-height:24px;padding:0;text-align:left">
                        Seu código de inscrição é: {{$dadosEmail['codigo']}}

                        <br> <br>
                        Abaixo está a cartilha com as informações sobre a categoria escolhida para competir:
                        <br> <br>
                        
                    </p>
                    <img alt="WBBF"
                        src="https://www.wbbfrj.com/img/categorias/{{$dadosEmail['categoria']->slug}}"
                        style="display:block;max-width: 500px;" class="CToWUd a6T" data-bit="iit"
                        tabindex="0">  
                        <br> <br> 
                </td>
            </tr>
        </tbody>
    </table>

@endsection
