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
                                    <span>ACOMPANHAR INSCRIÇÃO</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form id="inscricao-form" class="inscricao-form" action="{{ route('inscricao.store.ficha') }}" method="POST"style=" padding-top: 0;padding-bottom: 0;">
                        @csrf
        
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-box user-icon mb-30">
                                    <label for="codigo">Informe o código de inscrição recebido via e-mail</label>
                                    <input type="text" name="ccodigopf" id="codigo"  class="form-control required">        
                                </div>
                            </div>
        
                            <div class="col-lg-3 col-md-6">
                                <div class="form-box email-icon mb-30" style=" margin-top: 32px;">
                                    <button class="btn" type="button" style=" height: 60px;" id="btnBuscar">Buscar</button>
                                </div>
                            </div>     
                        </div>
                    </form>
                    
                    <!--End Section Tittle  -->
                    <div id="dados-inscricao-form" class="inscricao-form form-desabilitado">
                        @csrf
        
                        <h1>
                            Segue abaixo as informações da sua inscrição.
                        </h1>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-box user-icon mb-30">
                                    <label for="campeonato">Campeonato</label>
                                    <input type="text" name="cpf" id="campeonato"disabled class="form-control required">
        
                                </div>
                            </div>
        
                            <div class="col-lg-6 col-md-6">
                                <div class="form-box user-icon mb-30">
                                    <label for="categorias">Categoria</label>
                                    <input type="text" name="categoria" id="categoria"disabled class="form-control required">
        
                                </div>
                            </div>
        
                            <div class="col-lg-6 col-md-6">
                                <div class="form-box user-icon mb-30">
                                    <label for="sub_categoria_id">SubCategoria</label>
                                    <input type="text" name="sub_categoria_id" id="sub_categoria_id"disabled class="form-control required">
        
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-md-3">
                                <div class="form-box email-icon mb-30">
                                    <label for="cpf">CPF</label>
                                    <input type="text" name="cpf" id="cpf"disabled class="form-control required">
                                </div>
                            </div>   
                           
                            <div class="col-lg-3 col-md-3">
                                <div class="form-box email-icon mb-30">
                                    <label for="rg">RG</label>
                                    <input type="text" name="rg" id="rg"disabled class="form-control required">
                                </div>
                            </div>     
                        </div>
        
                        <div class="row">
        
                            <div class="col-lg-6 col-md-6">
                                <div class="form-box user-icon mb-30">
                                    <label for="nome">Nome</label>
                                    <input type="text" name="nome" id="nome"disabled class="form-control required">
                                </div>
                            </div>   
                            
                            <div class="col-lg-6 col-md-6">
                                <div class="form-box user-icon mb-30">
                                    <label for="academia_coach">Academia/Coach</label>
                                    <input type="text" name="academia_coach" id="academia_coach"disabled class="form-control required">
                                </div>
                            </div>          
                                                             
                            <div class="col-lg-3 col-md-3">
                                <div class="form-box email-icon mb-30">
                                    <label for="celular">Celular</label>
                                    <input type="text" name="celular" id="celular"disabled class="form-control required">
                                </div>
                            </div>      
                            <div class="col-lg-3 col-md-3">
                                <div class="form-box subject-icon mb-30">
                                    <label for="data_nascimento">Data de Nascimento</label>
                                    <input type="date" name="data_nascimento" id="data_nascimento"disabled class="form-control required">
                                </div>
                            </div>                             
                            <div class="col-lg-6 col-md-6">
                                <div class="form-box subject-icon mb-30">
                                    <label for="email">Email</label>
                                    <input type="Email" name="email" id="email"disabled class="form-control required">
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-box subject-icon mb-30">
                                    <label for="peso">Peso</label>
                                    <input type="text" name="peso" id="peso"disabled class="form-control required">
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-box subject-icon mb-30">
                                    <label for="numero">Número Atleta</label>
                                    <input type="text" name="numero" id="numero"disabled class="form-control required">
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-box subject-icon mb-30">
                                    <label for="status_pagamento">Status Pagamento</label>
                                    <input type="text" name="status_pagamento" id="status_pagamento"disabled class="form-control required">
                                </div>
                            </div>

                            {{-- ENDEREÇO  --}}
        
                            <div class="col-lg-3 col-md-3">
                                <div class="form-box email-icon mb-30">
                                    <label for="cep">CEP</label>
                                    <input type="text" name="cep" id="cep"disabled class="form-control required">
                                </div>
                            </div> 
        
                            <div class="col-lg-3 col-md-3">
                                <div class="form-box email-icon mb-30">
                                    <label for="estado">Estado</label>
                                    <input type="text" name="estado" id="estado"disabled class="form-control required"  maxlength="2">
        
                                </div>
                            </div>
        
                            <div class="col-lg-4 col-md-4">
                                <div class="form-box email-icon mb-30">
                                    <label for="cidade">Cidade</label>
                                    <input type="text" name="cidade" id="cidade"disabled class="form-control required">
                                </div>
                            </div>
        
                            <div class="col-lg-5 col-md-5">
                                <div class="form-box email-icon mb-30">
                                    <label for="bairro">Bairro</label>
                                    <input type="text" name="bairro" id="bairro"disabled class="form-control required">
                                </div>
                            </div>
        
                            <div class="col-lg-2 col-md-2">
                                <div class="form-box email-icon mb-30">
                                    <label for="numero">Número</label>
                                    <input type="text" name="numero" id="numero"disabled class="form-control required">
                                </div>
                            </div>
        
                            <div class="col-lg-10 col-md-10">
                                <div class="form-box email-icon mb-30">
                                    <label for="logradouro">Logradouro</label>
                                    <input type="text" name="logradouro" id="logradouro"disabled class="form-control required">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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

        .form-desabilitado{
            display: none;
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

                                $(".form-desabilitado").css('display','none');


                                $('#nome').val('');
                                $('#rg').val('');
                                $('#celular').val('');
                                $('#data_nascimento').val('');
                                $('#email').val('');
                                $('#cep').val('');
                                $('#estado').val('');
                                $('#cidade').val('');
                                $('#logradouro').val('');
                                $('#bairro').val('');
                                $('#numero').val('');
                                $('#academia_coach').val('');
                            }                          
                        }
                    });
                }         
            });

        });
    </script>
@endsection
