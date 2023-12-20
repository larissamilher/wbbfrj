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
                                            <h1 id="label-valor-compra">R$ {{  number_format( $campeonato->valor, 2, ',', '.')}}</h1>
                                        </div>      
                                    </div>
                                </div>   
                                <div class="col-lg-6 col-md-6">
                                    <div class="row" style="text-align: left;">
                                
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-box email-icon mb-30">
                                                <label for="nome_cartao">Nome no cartão <span>*</span> </label>
                                                <input type="text" name="nome_cartao" id="nome_cartao"  value="{{isset($retorno['cartao']['nome']) ?$retorno['cartao']['nome'] : '' }}">
                                            </div>
                                        </div>   
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-box email-icon mb-30">
                                                <label for="numero_cartao">Número do Cartão <span>*</span> </label>
                                                <input type="text" name="numero_cartao" id="numero_cartao"  value="{{isset($retorno['cartao']['numero']) ?$retorno['cartao']['numero'] : '' }}">
                                            </div>
                                        </div>  
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-box email-icon mb-30">
                                                <label for="validade_cartao">Data de validade <span>*</span> </label>
                                                <input type="text" name="validade_cartao" id="validade_cartao" value="{{isset($retorno['cartao']['validade']) ?$retorno['cartao']['validade'] : '' }}">
                                            </div>
                                        </div>  
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-box email-icon mb-30">
                                                <label for="nome_cartao">Código de segurança <span>*</span> </label>
                                                <input type="text" name="cvv" id="cvv"value="{{isset($retorno['cartao']['ccv']) ?$retorno['cartao']['ccv'] : '' }}">
                                            </div>
                                        </div>    
                                        <div class="col-lg-12 col-md-12" style=" margin-bottom: 3%;">
                                            <div class="form-box email-icon mb-30">
                                                <label for="parcelamento">Plano de parcelamento  <span>*</span> </label>
                                                <select name="parcelamento" id="parcelamento">
                                                    <option value="1" selected data-valor="{{  number_format( $campeonato->valor, 2, ',', '.')}}"> 
                                                        1 x R${{  number_format( $campeonato->valor, 2, ',', '.')}} *sem juros
                                                    </option>
                                                    <option value="2" data-valor="2 * {{ number_format((($campeonato->valor / 2) * (1 + 0.0249 * 2) + 0.49), 2, '.', '.') }}"> 
                                                        2 x R${{ number_format((($campeonato->valor / 2) * (1 + 0.0249 * 2) + 0.49), 2, ',', '.') }} *com juros
                                                    </option>
                                                    <option value="3" data-valor="3 * {{ number_format(($campeonato->valor / 3) * (1 + 0.0249 * 3) + 0.49, 2, '.', '.') }}">
                                                        3 x R${{ number_format(($campeonato->valor / 3) * (1 + 0.0249 * 3) + 0.49, 2, ',', '.') }} *com juros
                                                    </option>
                                                    <option value="4" data-valor=" 4 * {{ number_format(($campeonato->valor / 4) * (1 + 0.0249 * 4) + 0.49, 2, '.', '.') }}">
                                                        4 x R${{ number_format(($campeonato->valor / 4) * (1 + 0.0249 * 4) + 0.49, 2, ',', '.') }} *com juros
                                                    </option>
                                                </select>
                                            </div>
                                        </div>    
                                    </div>
                                </div>     
                                
                                @if(isset($retorno))
                                    @if(!$retorno['success'])
                                        <input type="hidden" id="erroPagamento" value="{{$retorno['message']}}">
                                    @endif
                                @endif
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

            if ($('#erroPagamento').length) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text:  $('#erroPagamento').val()
                });             
            }

            $('#validade_cartao').mask('99/9999');
            $('#cvv').mask('999');
            $('#numero_cartao').mask('9999-9999-9999-9999');
        });

        $(document).ready(function() {

            $('#parcelamento').on('change', function() {

                var dataValor = $('#parcelamento option:selected').data('valor');
                dataValor = dataValor.replace(/,/g, '.');
                var resultado = eval(dataValor);
                resultado = resultado.toFixed(2).replace('.', ',');

                $("#label-valor-compra").html('R$ ' + resultado);

            });        
        });

    </script>
@endsection