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
                        <form id="inscricao-form" class="inscricao-form" action="#" method="POST"style=" padding-top: 0;">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-box user-icon mb-30">
                                        <select id="campeonato" name="campeonato">
                                            <option value="">Selecione o Campeonato</option>
                                            @foreach($campeonatos as $campeonato)
                                                <option value="{{$campeonato->id}}">{{$campeonato->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-box user-icon mb-30">
                                        <select id="categorias" name="categorias">
                                            <option value="">Selecione a Categoria</option>                                           
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-box user-icon mb-30">
                                        <input type="text" name="nome" id="nome" placeholder="Nome">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-box email-icon mb-30">
                                        <input type="text" name="cpf" id="cpf" placeholder="CPF">
                                    </div>
                                </div>   
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-box email-icon mb-30">
                                        <input type="text" name="rg" id="rg" placeholder="RG">
                                    </div>
                                </div>       
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-box email-icon mb-30">
                                        <input type="text" name="celular" id="celular" placeholder="Celular">
                                    </div>
                                </div>      
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-box subject-icon mb-30">
                                        <input type="date" name="data_nascimento" id="data_nascimento" placeholder="Data de Nascimento">
                                    </div>
                                </div>                             
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-box subject-icon mb-30">
                                        <input type="Email" name="email" id="email" placeholder="Email">
                                    </div>
                                </div>

                                {{-- ENDEREÇO  --}}

                                <div class="col-lg-3 col-md-3">
                                    <div class="form-box email-icon mb-30">
                                        <input type="text" name="cep" id="cep" placeholder="CEP">
                                    </div>
                                </div> 

                                <div class="col-lg-3 col-md-3">
                                    <div class="form-box email-icon mb-30">
                                        <select id="estado" name="estado">
                                            <option value="">Selecione o Estado</option>
                                            <option value="AC">Acre</option>
                                            <option value="AL">Alagoas</option>
                                            <option value="AP">Amapá</option>
                                            <option value="AM">Amazonas</option>
                                            <option value="BA">Bahia</option>
                                            <option value="CE">Ceará</option>
                                            <option value="DF">Distrito Federal</option>
                                            <option value="ES">Espírito Santo</option>
                                            <option value="GO">Goiás</option>
                                            <option value="MA">Maranhão</option>
                                            <option value="MT">Mato Grosso</option>
                                            <option value="MS">Mato Grosso do Sul</option>
                                            <option value="MG">Minas Gerais</option>
                                            <option value="PA">Pará</option>
                                            <option value="PB">Paraíba</option>
                                            <option value="PR">Paraná</option>
                                            <option value="PE">Pernambuco</option>
                                            <option value="PI">Piauí</option>
                                            <option value="RJ">Rio de Janeiro</option>
                                            <option value="RN">Rio Grande do Norte</option>
                                            <option value="RS">Rio Grande do Sul</option>
                                            <option value="RO">Rondônia</option>
                                            <option value="RR">Roraima</option>
                                            <option value="SC">Santa Catarina</option>
                                            <option value="SP">São Paulo</option>
                                            <option value="SE">Sergipe</option>
                                            <option value="TO">Tocantins</option>
                                            <option value="EX">Estrangeiro</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-box email-icon mb-30">
                                        <select id="cidades" name="cidades">
                                            <option value="">Selecione a Cidade</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-box email-icon mb-30">
                                        <input type="text" name="endereco" id="endereco" placeholder="Endereço">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">                                   
                                    <div class="submit-info">
                                        <button class="btn" type="submit">Próxima Etapa</button>
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
        $('#cpf').mask('999.999.999-99');
        $('#rg').mask('00.000.000-0');
        $('#cep').mask('00000-000');
        $('#celular').mask('(00) 00000-0000');
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

        $('#estado').on('change',function() {
            $.ajax({
                url: "https://servicodados.ibge.gov.br/api/v1/localidades/estados/"+ $('#estado').val()+ '/municipios',
                type: 'GET',    
                success: function (response) {
                    
                    $('#cidades').empty();                        
                    $('#cidades').niceSelect('destroy');
                    $('#cidades').append('<option value="">Selecione a Cidade</option>');
                    
                    $.each(response, function(index, cidade) {
                        $('#cidades').append('<option value="' + cidade.nome + '">' + cidade.nome  + '</option>');
                    });

                    $('#cidades').niceSelect();                    
                }
            });
        });


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

    });

    </script>
@endsection