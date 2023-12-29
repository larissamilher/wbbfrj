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
                                        <span>INSCRIÇÃO FILIAÇÃO - DADOS DO ATLETA</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Section Tittle  -->
                        <form id="inscricao-form" class="inscricao-form" action="{{ route('inscricao.store.ficha') }}" method="POST"style=" padding-top: 0;">
                            @csrf

                            <div class="row">                                                               
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-box email-icon mb-30">
                                        <label for="cpf">CPF <span>*</span> </label>
                                        <input type="text" name="cpf" id="cpf" placeholder="" class="form-control required">
                                    </div>
                                </div>   
                               
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-box email-icon mb-30">
                                        <label for="rg">RG <span>*</span> </label>
                                        <input type="text" name="rg" id="rg" placeholder="" class="form-control required">
                                    </div>
                                </div>    
                                
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-box user-icon mb-30">
                                        <label for="nome">Nome <span>*</span> </label>
                                        <input type="text" name="nome" id="nome" placeholder="" class="form-control required">
                                    </div>
                                </div>   
                            </div>

                            <div class="row">
                                
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-box user-icon mb-30">
                                        <label for="academia_coach">Academia/Coach <span>*</span> </label>
                                        <input type="text" name="academia_coach" id="academia_coach" placeholder="" class="form-control required">
                                    </div>
                                </div>          
                                                                 
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-box email-icon mb-30">
                                        <label for="celular">Celular <span>*</span> </label>
                                        <input type="text" name="celular" id="celular" placeholder="" class="form-control required">
                                    </div>
                                </div>      
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-box subject-icon mb-30">
                                        <label for="data_nascimento">Data de Nascimento <span>*</span></label>
                                        <input type="date" name="data_nascimento" id="data_nascimento" placeholder="" class="form-control required">
                                    </div>
                                </div>                             
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-box subject-icon mb-30">
                                        <label for="email">Email <span>*</span> </label>
                                        <input type="Email" name="email" id="email" placeholder="" class="form-control required">
                                    </div>
                                </div>

                                {{-- ENDEREÇO  --}}

                                <div class="col-lg-3 col-md-3">
                                    <div class="form-box email-icon mb-30">
                                        <label for="cep">CEP <span>*</span> </label>
                                        <input type="text" name="cep" id="cep" placeholder="" class="form-control required">
                                    </div>
                                </div> 

                                <div class="col-lg-3 col-md-3">
                                    <div class="form-box email-icon mb-30">
                                        <label for="estado">Estado <span>*</span> </label>
                                        <input type="text" name="estado" id="estado" placeholder="" class="form-control required"  maxlength="2">

                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3">
                                    <div class="form-box email-icon mb-30">
                                        <label for="cidade">Cidade <span>*</span> </label>
                                        <input type="text" name="cidade" id="cidade" placeholder="" class="form-control required">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3">
                                    <div class="form-box email-icon mb-30">
                                        <label for="bairro">Bairro <span>*</span> </label>
                                        <input type="text" name="bairro" id="bairro" placeholder="" class="form-control required">
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-2">
                                    <div class="form-box email-icon mb-30">
                                        <label for="numero">Número <span>*</span> </label>
                                        <input type="text" name="numero" id="numero" placeholder="" class="form-control required">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <div class="form-box email-icon mb-30">
                                        <label for="logradouro">Logradouro <span>*</span> </label>
                                        <input type="text" name="logradouro" id="logradouro" placeholder="" class="form-control required">
                                    </div>
                                </div>
                            </div>

                            <div class="row">                                                               
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-box email-icon mb-30">
                                        <label for="selfie">Envie sua foto de rosto  <span>*</span> </label>
                                        <input type="file" name="selfie" id="selfie" placeholder="" class="form-control required">
                                    </div>
                                </div>                                 
                            </div>

                            @if(isset($errorMessage))
                                <input type="hidden" id="errorMessage" value="{{$errorMessage}}">
                            @endif

                            <div class="row">
                                <div class="col-lg-6">                                   
                                    <div class="form-box email-icon mb-30" style="margin-right: 15px;display: flex;align-items: center;margin-bottom: 0;">
                                        <input type="checkbox" name="autorizacao_uso_imagem" id="autorizacao_uso_imagem" class="form-control required" style="height: 20px;margin-right: 5px;width: 20px;">
                                        <label for="autorizacao_uso_imagem">Autorizo o uso da minha imagem. <span>*</span> </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">                                   
                                    <div class="form-box email-icon mb-30" style="margin-right: 15px; display: flex; align-items: center;">
                                        <input type="checkbox" name="termos_atleta" id="termos_atleta" class="form-control required" style="height: 20px;margin-right: 5px;width: 20px;">
                                        <label for="autorizacao_uso_imagem">Aceito os termos de atleta após ler atentamente. Para ler,  
                                            <a href="https://wbbfrj.com/termo/termo.pdf" target="_blank" style=" color: #ff1313;">clique aqui</a>.<span>*</span> </label>
                                    </div>
                                </div>
                            </div>

                            <span>* Campos obrigatórios</span>

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
            /* max-height: 300px;  */
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
                                $('#categorias').append('<option value="' + categoria.id + '">' + categoria.nome + '</option>');
                            });

                            $('#categorias').niceSelect();
                        }  
                        
                    }
                });
            }

        });
        
        $('#categorias').on('change', function() {
            var categoriaSelecionada = $(this).val();

            if(categoriaSelecionada){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/campeonatos/inscricao/get-sub-categorias-campeonato/"+ categoriaSelecionada,
                    type: 'GET',    
                    success: function (response) {
                    
                        if (response.success) {   
                            $('#sub_categoria_id').empty();
                            
                            $('#sub_categoria_id').niceSelect('destroy');

                            $('#sub_categoria_id').append('<option value="">Selecione a categoria</option>');
                            
                            $.each(response.dados, function(index, subcategoria) {
                                $('#sub_categoria_id').append('<option value="' + subcategoria.id + '">' + subcategoria.nome + '</option>');
                            });

                            $('#sub_categoria_id').niceSelect();
                        }  
                        
                    }
                });
            }
        });

        $('#email').on('change',function() {
            var email = $('#email').val();
            if (!validarEmail(email)) {
                $('#email').val('');
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: 'Insira um E-mail válido!'
                });
            }
        });

        // $('#rg').on('change',function() {
        //     var rg = $('#rg').val();
        //     if (!validarRg(rg)) {
        //         $('#rg').val('');
        //         Swal.fire({
        //             icon: "error",
        //             title: "Oops...",
        //             text: 'Insira um RG válido!'
        //         });
        //     }             
        // });

        $('#cpf').on('change',function() {
            var cpf = $('#cpf').val().replace(/\D/g, ''); 
            if (!validarCPF(cpf)) {
                $('#cpf').val('');
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: 'Insira um CPF válido!'
                });
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

        $("#inscricao-form").submit(function (event) {
            event.preventDefault();

            var error = false;
            var camposVazios = [];

            if ($("#campeonato").val() == '') {
                error = true;
                camposVazios.push('Campeonato');
            }

            if ($("#categorias").val() == '') {
                error = true;
                camposVazios.push('Categoria');
            }

            $(".required").each(function () {
                if ($(this).val() === "") {
                    error = true;
                    if ($(this).attr('name') == 'data_nascimento')
                        camposVazios.push('Data de Nascimento');
                    else
                        camposVazios.push($(this).attr('name'));
                }
            });

            var checkbox = document.getElementById("autorizacao_uso_imagem");

            if (!checkbox.checked){
                error = true;
                camposVazios.push('Autorizo o uso da minha imagem');
            }

            if (error) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: 'Preencha os campos obrigatórios:' + camposVazios.join(', ')
                });
            } else {
                document.getElementById("inscricao-form").submit();
            }
        });

        $('#cpf').on('change', function() {
            var cpf = $(this).val();

            if(cpf){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/campeonatos/inscricao/get-dados-cpf/"+ cpf.replace(/[.-]/g, ""),
                    type: 'GET',    
                    success: function (retorno) {                       
                        if (retorno.success) {   
                            $('#nome').val(retorno.dados.nome);
                            $('#rg').val(retorno.dados.rg);
                            $('#celular').val(retorno.dados.celular);
                            $('#data_nascimento').val(retorno.dados.data_nascimento);
                            $('#email').val(retorno.dados.email);
                            $('#cep').val(retorno.dados.cep);
                            $('#estado').val(retorno.dados.estado);
                            $('#cidade').val(retorno.dados.cidade);
                            $('#logradouro').val(retorno.dados.logradouro);
                            $('#bairro').val(retorno.dados.bairro);
                            $('#numero').val(retorno.dados.numero);
                            $('#academia_coach').val(retorno.dados.academia_coach);
                        }else{
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