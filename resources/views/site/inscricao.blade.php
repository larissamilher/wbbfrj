@extends('layouts.site')

@section('content')
    
<section class="inscricao-form-main">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-xl-12 col-lg-12">
                    <div class="form-wrapper">
                        <!--Section Tittle  -->
                        <div class="form-tittle">
                            <div class="row ">
                                <div class="col-lg-11 col-md-10 col-sm-10">
                                    <div class="section-tittle">
                                        <span>INSCRIÇÃO</span>
                                        <h3>Preencha a ficha de inscrição!</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Section Tittle  -->
                        <form id="inscricao-form" action="#" method="POST">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-box user-icon mb-30">
                                        <select id="campeonato">
                                            <option value="">Selecione o Campeonato</option>
                                            @foreach($campeonatos as $campeonato)
                                                <option value="{{$campeonato->id}}">{{$campeonato->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-box user-icon mb-30">
                                        <select id="categorias">
                                            <option value="">Selecione a Categoria</option>
                                           
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-box user-icon mb-30">
                                        <input type="text" name="name" placeholder="Nome">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-box email-icon mb-30">
                                        <input type="text" name="celular" placeholder="Celular">
                                    </div>
                                </div>                                   
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-box subject-icon mb-30">
                                        <input type="Email" name="subject" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-box message-icon mb-65">
                                        <textarea name="message" id="message" placeholder="Mensagem"></textarea>
                                    </div>
                                    <div class="submit-info">
                                        <button class="btn" type="submit">Enviar Mensagem</button>
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
    });

    </script>
@endsection