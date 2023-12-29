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
                                            <input type="hidden" id="compra_id" disabled class="form-control required" value="{{$compra->id}}">

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
                                        <button class="btn" type="button" id="bntValidar" style="width: 100%">VALIDAR</button>
                                    </div>   
                                </div>
                            @else
                                <h1 style="color: #c50404;FONT-SIZE: 30PX;">
                                    Erro: Este ingresso já foi utilizado. <br> Certifique-se de não haver duplicatas.
                                </h1>
                            @endif
                        @else
                            <h1 style="color: #c50404;FONT-SIZE: 30PX;">
                                SÓ É PERMITIDO VALIDAR UMA COMPRA/INGRESSO NO DIA DO EVENTO.
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
            $('#bntValidar').on('click', function() {
                var compra_id = $("#compra_id").val();

                if(compra_id){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/eventos/validar-acao/"+ compra_id,
                        type: 'GET',    
                        success: function (retorno) {                       
                            if (retorno.success) {   
                                Swal.fire({
                                    title: "Entrada Liberada!",
                                    text: "Ingresso Validado!",
                                    icon: "success"
                                }).then((result) => {
                                    if (result.isConfirmed) 
                                        window.location.href =  window.location.origin;                     
                                });
                            }else
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: retorno.message
                                });             
                        }
                    });
                }         
            });

        });
    </script>
@endsection
