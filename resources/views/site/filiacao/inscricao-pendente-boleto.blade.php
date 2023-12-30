@extends('layouts.site')

@section('content')
    
<section class="inscricao-form-main">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-xl-12 col-lg-12">
                    <div class="form-wrapper">
                        <!--Section Tittle  -->
                        <div class="form-tittle" style="text-align: center;">
                            <div class="row "  style=" margin-top: 10%; ">
                                <div class="col-lg-11 col-md-10 col-sm-10">
                                    <div class="section-tittle">
                                        <h1>
                                            Sua filiação está pendente e aguardando o pagamento do boleto.
                                        </h1>

                                        <p>
                                            Para efetuar o pagamento, você tem duas opções:
                                        </p>
                                        <p>
                                            1. Ler o código de barras direto em seu APP de pagamentos.                                                                                     
                                        </p>
                                        
                                        <a href="{{ env('URL_ASAAS_AMBIENTE')}}/b/pdf/{{$pagamentoId}}" target="_blank">
                                            <button class="btn" type="button">VISUALIZAR BOLETO</button>
                                        </a>

                                        <p>
                                            2. Copiar e colar o código de barras em seu APP de pagamentos.<br>  
                                        </p>

                                        <h3 id="chavePix">{{$pagamentoRetorno->barCode}}</h3>

                                        <button class="btn" type="button" id="copiarCodigo">COPIAR CÓDIGO DE BARRAS</button>

                                        <br>

                                        <p style="MARGIN-TOP: 2%; "> 
                                            Após a confirmação, você receberá um e-mail com os detalhes da sua candidatura.
                                        </p>
                                        <p>
                                            Agradecemos pela participação. <br>
                                            Atenciosamente, WBBF RJ
                                        </p>
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
        h1{
            font-size: 50px;
            font-weight: 300;
            color: #ffc107;
        }

        button{
            background-color: #009688 !important;
        }

        .btn::before{
            background:#016b60 !important;
        }
    </style>

    <script>
        document.getElementById("copiarCodigo").addEventListener("click", function() {
            var chavePix = document.getElementById("chavePix");
            var tempInput = document.createElement("input");
            tempInput.value = chavePix.textContent;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);

            Swal.fire({
                title: "Bom Trabalho!",
                text: "Código de barras copiado para a área de transferência!",
                icon: "success"
            });
        });
    </script>
@endsection