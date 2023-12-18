@extends('layouts.email')

@section('content').

    <p style="margin:0;margin-bottom:20px;color:#000;font-family:Georgia,Arial,sans-serif;font-size:32px;font-weight:normal;line-height:40px;padding:0;text-align:left">
        <strong>olá!</strong>
    </p>

    <p style="margin:0;margin-bottom:20px;color:#000;font-family:Arial,sans-serif;font-size:22px;font-weight:normal;line-height:32px;padding:0;text-align:left">
        Gostaríamos de informar que uma nova mensagem foi recebida através do formulário de contato do nosso site. Abaixo estão os detalhes da mensagem:
    </p>

    <table align="center" style="width:100%">
        <tbody>
            <tr>
                <td>
                    <p style="margin:0;margin-bottom:0;color:#121212;font-family:Arial,sans-serif;font-size:16px;font-weight:normal;line-height:24px;padding:0;text-align:left">
                        <strong> Nome do Remetente:</strong> {{$dadosEmail['name']}} <br/>

                        <strong>Endereço de E-mail:</strong>{{$dadosEmail['email']}} <br/>

                        <strong>Celular:</strong> {{$dadosEmail['celular']}} <br/>

                        <strong>Mensagem:</strong>  <br/> {{$dadosEmail['message']}} <br/><br/><br/>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

@endsection
