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
                                            Sua inscrição está pendente e aguardando o pagamento via Pix.
                                        </h1>

                                        <p>
                                            Para efetuar o pagamento, você tem duas opções:
                                        </p>
                                        <p>
                                            1. Escaneie o código QR abaixo com seu APP de pagamentos.                                                                                     
                                        </p>
                                        <img class="js-pix-qr-code" height="160px" width="160px" src="data:image/jpeg;base64, {{$pagamentoRetorno->encodedImage}}" alt="QR Code Pix">
                                        
                                        <p>
                                            2. Copie e cole a Chave Pix em seu APP de pagamentos.<br>  
                                        </p>

                                        <h3 id="chavePix">{{$pagamentoRetorno->payload}}</h3>

                                        <button class="btn" type="button" id="copiarCodigo">COPIAR CHAVE</button>

                                        <br>

                                        <p style="MARGIN-TOP: 2%; "> 
                                            Após a confirmação, você receberá um e-mail com os detalhes da inscrição.
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
                text: "Chave Pix copiada para a área de transferência!",
                icon: "success"
            });
        });
    </script>
@endsection