@extends('layouts.email')

@section('content').

    <p style="margin:0;margin-bottom:20px;color:#000;font-family:Georgia,Arial,sans-serif;font-size:32px;font-weight:normal;line-height:40px;padding:0;text-align:left">
        <strong>olá!</strong>
    </p>

    <p style="margin:0;margin-bottom:20px;color:#000;font-family:Arial,sans-serif;font-size:22px;font-weight:normal;line-height:32px;padding:0;text-align:left">
        Foi criado um usuário para o e-mail {{$dadosEmail['email']}} com sucesso.
    </p>

    <table align="center" style="width:100%">
        <tbody>
            <tr>
                <td>
                    <p style="margin:0;margin-bottom:0;color:#121212;font-family:Arial,sans-serif;font-size:16px;font-weight:normal;line-height:24px;padding:0;text-align:left">
                        <strong>Detalhes do usuário:</strong>  <br/>

                        <strong>E-mail:</strong>{{$dadosEmail['email']}} <br/>

                        <strong>Senha:</strong> {{$dadosEmail['senha']}} <br/>

                        <strong>URL para acessar o sistema:</strong>  <br/> {{$dadosEmail['url']}} <br/><br/><br/>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

@endsection
