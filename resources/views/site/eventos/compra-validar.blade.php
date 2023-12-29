@extends('layouts.site')

@section('content')
       
<section class="inscricao-form-main">
    <div class="container">
        <div class="row justify-content-end" style="    min-height: 700px;        ">
            <div class="col-xl-12 col-lg-12">
                <div class="form-wrapper">
                    <!--Section Tittle  -->
                    <div class="form-tittle">
                        <div class="row "  style=" margin-top: 5%; ">
                            <div class="col-lg-11 col-md-10 col-sm-10">
                                <div class="section-tittle">
                                    <span>VALIDAR COMPRA</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--End Section Tittle  -->
                    <div class="inscricao-form form-desabilitado">
                        @csrf

                        @if($compra->evento->data_evento === date('Y-m-d'))
        
                            @if(empty($compra->data_usado))
                                <h1 style="color: #0e8900;FONT-SIZE: 30PX;">
                                    INGRESSO VÁLIDO. PAGAMENTO CONFIRMADO
                                </h1>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-box user-icon mb-30">
                                            <label for="campeonato">Evento</label>
                                            <input type="text" disabled class="form-control required" value="{{$compra->evento->nome}}">
                
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-box email-icon mb-30">
                                            <label for="cpf">Descrição</label>
                                            <input type="text" name="cpf" id="cpf"disabled class="form-control required"  value="{{$compra->evento->descricao}}">
                                        </div>
                                    </div>     
                                </div>

                                <div class="row">                            
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-box email-icon mb-30">
                                            <label for="cpf">CPF</label>
                                            <input type="text" name="cpf" id="cpf"disabled class="form-control required"  value="{{$compra->cpf}}">
                                        </div>
                                    </div>   
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-box user-icon mb-30">
                                            <label for="nome">Nome</label>
                                            <input type="text" name="nome" id="nome"disabled class="form-control required"  value="{{$compra->nome}}" >
                                        </div>
                                    </div>   
                                </div>

                                <div class="row">   
                                    <div class="col-lg-3 col-md-3">
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <button class="btn" type="button" id="copiarCodigo" style="width: 100%">VALIDAR</button>
                                    </div>   
                                </div>
                            @else
                                <h1 style="color: #c50404;FONT-SIZE: 30PX;">
                                    Erro: Este ingresso já foi utilizado. <br> Certifique-se de não haver duplicatas.
                                </h1>
                            @endif
                        @else
                            <h1 style="color: #c50404;FONT-SIZE: 30PX;">
                                SÓ É PERMITIDO VALIDAR UMA COMPRA/EVENTO NO DIA DO EVENTO.
                            </h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
  
    button{
        background-color: #009688 !important;
    }

    .btn::before{
        background:#016b60 !important;
    }
</style>

    <style>
        ul.list {
            max-height: 300px; 
            overflow-y: auto;
        }
        button{
            background-color: #009688 !important;
        }

        .btn::before{
            background:#016b60 !important;
        }

       
        .form-desabilitado input{
            cursor: not-allowed;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('#btnBuscar').on('click', function() {
                var codigo = $("#codigo").val();

                if(codigo){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/campeonatos/inscricao/get-dados-inscricao/"+ codigo.replace('/', "-"),
                        type: 'GET',    
                        success: function (retorno) {                       
                            if (retorno.success) {   

                                $(".form-desabilitado").css('display','block');

                                $('html, body').animate({
                                    scrollTop: $(".form-desabilitado").offset().top
                                }, 1000);

                                $('#campeonato').val(retorno.dados.campeonato.nome);
                                $('#sub_categoria_id').val(retorno.dados.categoria.nome);
                                $('#categoria').val(retorno.dados.categoria.categoria.nome);
                                $('#status_pagamento').val(retorno.dados.status_pagamento);

                                $('#nome').val(retorno.dados.atleta.nome);
                                $('#rg').val(retorno.dados.atleta.rg);
                                $('#cpf').val(retorno.dados.atleta.cpf);
                                $('#celular').val(retorno.dados.atleta.celular);
                                $('#data_nascimento').val(retorno.dados.atleta.data_nascimento);
                                $('#email').val(retorno.dados.atleta.email);
                                $('#cep').val(retorno.dados.atleta.cep);
                                $('#estado').val(retorno.dados.atleta.estado);
                                $('#cidade').val(retorno.dados.atleta.cidade);
                                $('#logradouro').val(retorno.dados.atleta.logradouro);
                                $('#bairro').val(retorno.dados.atleta.bairro);
                                $('#numero').val(retorno.dados.atleta.numero);
                                $('#academia_coach').val(retorno.dados.atleta.academia_coach);
                                $('#peso').val(retorno.dados.peso);
                                $('#numero_atleta').val(retorno.dados.numero_atleta);
                            }else{

                                Swal.fire(retorno.message);

                                $(".form-desabilitado").css('display','none');


                            }                          
                        }
                    });
                }         
            });

        });
    </script>
@endsection
