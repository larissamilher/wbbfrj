@extends('layouts.site')

@section('content')
    
<section class="inscricao-form-main">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-xl-12 col-lg-12">
                    <div class="form-wrapper">
                        <!--Section Tittle  -->
                        <div class="form-tittle">
                            <div class="row " style=" margin-top: 5%; ">
                                <div class="col-lg-11 col-md-10 col-sm-10">
                                    <div class="section-tittle">
                                        <span>INSCRIÇÃO - DADOS DE PAGAMENTO</span>
                                        <h3></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Section Tittle  -->
                        <form id="inscricao-form" class="inscricao-form" action="{{ route('inscricao.pagamento') }}"  method="POST" style=" padding-top: 0;">
                            @csrf
                            <div class="row" style="    text-align: center;">
                                
                                <div class="col-lg-6 col-md-6">
                                    <div class="row" style=" margin-top: 15%; ">
                                
                                        <div class="col-lg-12 col-md-12 resumo-compra">
                                            <h3>Resumo da Compra</h3>
                                            <h1>{{$campeonato->nome}}</h1>
                                            <h2> Valor Total da Compra </h2>
                                            <h1>R$ {{  number_format( $campeonato->valor, 2, ',', '.')}}</h1>
                                        </div>      
                                    </div>
                                </div>   
                                <div class="col-lg-6 col-md-6">
                                    <div class="row">
                                
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-box email-icon mb-30">
                                                <input type="text" name="nome_cartao" id="nome_cartao" placeholder="Nome no cartão">
                                            </div>
                                        </div>   
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-box email-icon mb-30">
                                                <input type="text" name="numero_cartao" id="numero_cartao" placeholder="Número do Cartão">
                                            </div>
                                        </div>  
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-box email-icon mb-30">
                                                <input type="text" name="validade_cartao" id="validade_cartao" placeholder="Data de validade">
                                            </div>
                                        </div>  
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-box email-icon mb-30">
                                                <input type="text" name="cvv" id="cvv" placeholder="Código de segurança">
                                            </div>
                                        </div>    
                                    </div>
                                </div>       
                            </div>

                            <div class="row">
                                <div class="col-lg-6">   
                                </div>
                                <div class="col-lg-6">                                   
                                    <div class="submit-info">
                                        <button class="btn" type="submit" style="width: 100%;">Finalizar Compra</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>

    $(document).ready(function($) {
        $('#validade_cartao').mask('99/9999');
        $('#cvv').mask('999');
        $('#numero_cartao').mask('9999-9999-9999-9999');
    });

    $(document).ready(function() {

     
    });

    </script>
@endsection