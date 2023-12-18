@extends('layouts.site')

@section('content')
    
<section class="inscricao-form-main">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-xl-12 col-lg-12">
                    <div class="form-wrapper">
                        <!--Section Tittle  -->
                        <div class="form-tittle">
                            <div class="row "  style=" margin-top: 5%; ">
                                <div class="col-lg-11 col-md-10 col-sm-10">
                                    <div class="section-tittle">
                                        <span>INSCRIÇÃO - DADOS DO ATLETA</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Section Tittle  -->
                        <form id="inscricao-form" class="inscricao-form" action="{{ route('inscricao.store.ficha') }}" method="POST"style=" padding-top: 0;">
                            @csrf

                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-box user-icon mb-30">
                                        <label for="campeonato">Campeonato</label>
                                        <select id="campeonato" name="campeonato" class="form-control required">
                                            <option value="">Selecione o Campeonato</option>
                                            @foreach($campeonatos as $campeonato)
                                                <option value="{{$campeonato->id}}">{{$campeonato->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-box user-icon mb-30">
                                        <label for="categorias">Categoria</label>
                                        <select id="categorias" name="categorias" class="form-control required">
                                            <option value="">Selecione a Categoria</option>                                           
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-box user-icon mb-30">
                                        <label for="nome">Nome</label>
                                        <input type="text" name="nome" id="nome" placeholder="" class="form-control required">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-box email-icon mb-30">
                                        <label for="cpf">CPF</label>
                                        <input type="text" name="cpf" id="cpf" placeholder="" class="form-control required">
                                    </div>
                                </div>   
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-box email-icon mb-30">
                                        <label for="rg">RG</label>
                                        <input type="text" name="rg" id="rg" placeholder="" class="form-control required">
                                    </div>
                                </div>       
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-box email-icon mb-30">
                                        <label for="celular">Celular</label>
                                        <input type="text" name="celular" id="celular" placeholder="" class="form-control required">
                                    </div>
                                </div>      
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-box subject-icon mb-30">
                                        <label for="data_nascimento">Data de Nascimento</label>
                                        <input type="date" name="data_nascimento" id="data_nascimento" placeholder="" class="form-control required">
                                    </div>
                                </div>                             
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-box subject-icon mb-30">
                                        <label for="email">Email</label>
                                        <input type="Email" name="email" id="email" placeholder="" class="form-control required">
                                    </div>
                                </div>

                                {{-- ENDEREÇO  --}}

                                <div class="col-lg-3 col-md-3">
                                    <div class="form-box email-icon mb-30">
                                        <label for="cep">CEP</label>
                                        <input type="text" name="cep" id="cep" placeholder="" class="form-control required">
                                    </div>
                                </div> 

                                <div class="col-lg-3 col-md-3">
                                    <div class="form-box email-icon mb-30">
                                        <label for="estado">Estado</label>
                                        <input type="text" name="estado" id="estado" placeholder="" class="form-control required"  maxlength="2">

                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-box email-icon mb-30">
                                        <label for="cidade">Cidade</label>
                                        <input type="text" name="cidade" id="cidade" placeholder="" class="form-control required">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <div class="form-box email-icon mb-30">
                                        <label for="bairro">Bairro</label>
                                        <input type="text" name="bairro" id="bairro" placeholder="" class="form-control required">
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-2">
                                    <div class="form-box email-icon mb-30">
                                        <label for="numero">Número</label>
                                        <input type="text" name="numero" id="numero" placeholder="" class="form-control required">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-box email-icon mb-30">
                                        <label for="logradouro">Logradouro</label>
                                        <input type="text" name="logradouro" id="logradouro" placeholder="" class="form-control required">
                                    </div>
                                </div>
                            </div>

                            @if(isset($errorMessage))
                                <input type="hidden" id="errorMessage" value="{{$errorMessage}}">
                            @endif

                            <div class="row">
                                <div class="col-lg-12">                                   
                                    <div class="submit-info">
                                        <button class="btn" type="submit" style="width: 50%; margin-left: 25%;">Próxima Etapa</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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

    </style>
    <script>

    $(document).ready(function($) {
        $('#cpf').mask('999.999.999-99');
        $('#rg').mask('00.000.000-0');
        $('#cep').mask('00000-000');
        $('#celular').mask('(00) 00000-0000');

        if ($('#errorMessage').length) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text:  $('#errorMessage').val()
            });             
        }
    });

    $(document).ready(function() {

        $('#campeonato').on('change', function() {
            var campeonatoSelecionado = $(this).val();

            if(campeonatoSelecionado){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/campeonatos/inscricao/get-categorias-campeonato/"+ campeonatoSelecionado,
                    type: 'GET',    
                    success: function (response) {
                       
                        if (response.success) {   
                            $('#categorias').empty();
                            
                            $('#categorias').niceSelect('destroy');

                            $('#categorias').append('<option value="">Selecione a categoria</option>');
                            
                            $.each(response.dados, function(index, categoria) {
                                $('#categorias').append('<option value="' + categoria.categoria.id + '">' + categoria.categoria.nome + '</option>');
                            });

                            $('#categorias').niceSelect();
                        }  
                        
                    }
                });
            }
         
        });

        // $('#estado').on('change',function() {
        //     $.ajax({
        //         url: "https://servicodados.ibge.gov.br/api/v1/localidades/estados/"+ $('#estado').val()+ '/municipios',
        //         type: 'GET',    
        //         success: function (response) {
                    
        //             $('#cidade').empty();                        
        //             $('#cidade').niceSelect('destroy');
        //             $('#cidade').append('<option value="">Selecione a Cidade</option>');
                    
        //             $.each(response, function(index, cidade) {
        //                 $('#cidade').append('<option value="' + cidade.nome + '">' + cidade.nome  + '</option>');
        //             });

        //             $('#cidade').niceSelect();                    
        //         }
        //     });
        // });


        $('#email').on('change',function() {
            var email = $('#email').val();
            if (!validarEmail(email)) {
                $('#email').val('')
                alert('E-mail inválido!');
            }
        });

        $('#rg').on('change',function() {
            var rg = $('#rg').val();
            if (!validarRg(rg)) {
                alert('RG inválido!');
                $('#rg').val('')
            }             
        });

        $('#cpf').on('change',function() {
            var cpf = $('#cpf').val().replace(/\D/g, ''); 
            if (!validarCPF(cpf)) {
                alert('CPF inválido!');
                $('#cpf').val('');
            } 
        });

        function validarCPF(cpf) {
            var regex = /^\d{11}$/;

            if (!regex.test(cpf)) 
                return false;

            var soma = 0;
            for (var i = 0; i < 9; i++) {
                soma += parseInt(cpf.charAt(i)) * (10 - i);
            }
            var resto = (soma * 10) % 11;

            if ((resto === 10) || (resto === 11)) 
                resto = 0;
            
            if (resto !== parseInt(cpf.charAt(9))) 
                return false;
            
            soma = 0;
            for (var i = 0; i < 10; i++) {
                soma += parseInt(cpf.charAt(i)) * (11 - i);
            }
            resto = (soma * 10) % 11;

            if ((resto === 10) || (resto === 11)) 
                resto = 0;
            
            if (resto !== parseInt(cpf.charAt(10))) 
                return false;
        
            return true;
        }

        function validarRg(rg) {
            // Expressão regular para validar RG (exemplo: XX.XXX.XXX-X)
            var regex = /^[0-9]{2}\.[0-9]{3}\.[0-9]{3}-[0-9A-Za-z]{1}$/;
            return regex.test(rg);
        }

        function validarEmail(email) {
            var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }

        // $("#inscricao-form").submit(function (event) {
        //     event.preventDefault();

        //     error = false;

        //     $(".required").each(function () {
        //         if ($(this).val() === "") 
        //             error = true                
        //     });

        //     if(error)
        //         alert('Preencha os dados obrigatórios!')
        //     else
        //         $("#inscricao-form").submit();
        // });
    });

    $(document).on('blur', '#inscricao-form input[name="cep"]', function () {
        var cep = $(this).val().replace(/\D/g, '');

        if (cep.length == 8) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/getcep",
                dataType: 'json',
                type: 'POST',
                data: {
                    'cep': cep
                },
                beforeSend: function () {
                    $('.loader').fadeIn();
                },
                success: function (result) {
                    // console.log(result);
                    if (result && !result.erro) {
                        $('#inscricao-form input[name="logradouro"]').val(result.logradouro);
                        $('#inscricao-form input[name="bairro"]').val(result.bairro);
                        $('#inscricao-form input[name="cidade"]').val(result.localidade);
                        $('#inscricao-form input[name="estado"]').val(result.uf);
                    } else {
                        toastr.error("CEP não encontrado, tente novamente.");
                        $('#inscricao-form input[name="logradouro"], #inscricao-form input[name="bairro"], #inscricao-form input[name="cidade"], #inscricao-form input[name="estado"]').val('');
                    }
                    $('.loader').fadeOut();
                }
            });
        }
    });

    </script>
@endsection