@extends('layouts.site')

@section('content')    
    <section class="contact-form-main">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-xl-12 col-lg-12">
                    <div class="form-wrapper">
                        <!--Section Tittle  -->
                        <div class="form-tittle">
                            <div class="row ">
                                <div class="col-lg-11 col-md-10 col-sm-10">
                                    <div class="section-tittle">
                                        <span>CONTATO</span>
                                        <h3>Sinta-se à vontade para entrar em contato conosco!</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(session('success'))
                            <script>
                                Swal.fire({
                                    title: "Bom trabalho!",
                                    text: "{{ session('success') }}",
                                    icon: "success"
                                });
                            </script>
                        @endif

                        <form id="contact-form"  action="{{ route('formulario-contato') }}" method="POST" method="POST">
                            @csrf
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
                                        <input type="Email" name="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-box message-icon mb-65" style="margin-bottom: 35px;">
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

    <style>
         @media screen and (max-device-width: 800px) {
            .container{
                margin-top: 15%;

            }
        }
    </style>
@endsection
