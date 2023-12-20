@extends('layouts.site')

@section('content')
    <!--? sobre Area Start-->
    <div class="slider-area position-relative">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-7 col-lg-9 col-md-8 col-sm-9">
                            <div class="hero__caption">
                                {{-- <span data-animation="fadeInLeft" data-delay="0.1s">
                                    Desafio Supremo: Federação WBBF RJ de Fisiculturismo
                                </span> --}}
                                <h1 data-animation="fadeInLeft" data-delay="0.4s">
                                    Conquiste a glória! Inscreva-se agora e faça parte da elite do fisiculturismo.
                                </h1>

                                <a href="{{route('inscricao')}}" class="btn">Inscreva-se Agora</a>
                            </div>
                        </div>
                    </div>
                </div>          
            </div>
            <!-- Single Slider -->
            <div class="single-slider slider-height d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-7 col-lg-9 col-md-8 col-sm-9">
                            <div class="hero__caption">
                                {{-- <span data-animation="fadeInLeft" data-delay="0.1s">WBBF - WORLD BODYBUILDING FEDERATION  </span> --}}
                                <h1 data-animation="fadeInLeft" data-delay="0.4s">
                                    Conquiste a glória! Inscreva-se agora e faça parte da elite do fisiculturismo.
                                </h1>
                                <a href="{{route('inscricao')}}" class="btn">Inscreva-se Agora</a>

                            </div>
                        </div>
                    </div>
                </div>          
            </div>
        </div>
        <!-- Video icon -->
        <!-- <div class="video-icon">
            <a class="popup-video btn-icon" href="https://www.youtube.com/watch?v=up68UAfH0d0"><i class="fas fa-play"></i></a>
        </div> -->
    </div>
    <!-- sobre Area End-->
    <!--? sobre Area Start -->
    <section class="about-area section-padding30">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <!-- about-img -->
                    <div class="about-img ">
                        <img src="{{ asset('img/gallery/mulher2.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="about-caption">
                        <!-- Section Tittle -->
                        <div class="section-tittle section-tittle3 mb-35">
                            <span>SOBRE</span>
                            <h2>WBBF RJ - WORLD BODYBUILDING FEDERATION </h2>
                        </div>
                        <p class="pera-top">
                            Vestibulum sed dui pharetra, viverra diam vel, blandit velit. 
                            Aliquam vulputate mauris ac lectus sodales rutrum. 
                            Vestibulum sed dui pharetra, viverra diam vel, blandit velit. 
                            Aliquam vulputate mauris ac lectus sodales rutrum. 
                            Vestibulum sed dui pharetra, viverra diam vel, blandit velit. 
                            Aliquam vulputate mauris ac lectus sodales rutrum. 
                            Vestibulum sed dui pharetra, viverra diam vel, blandit velit. 
                            Aliquam vulputate mauris ac lectus sodales rutrum. 
                            Vestibulum sed dui pharetra, viverra diam vel, blandit velit. 
                            Aliquam vulputate mauris ac lectus sodales rutrum. 
                        </p>
                        <p class="mb-65 pera-bottom">
                            Vestibulum sed dui pharetra, viverra diam vel, blandit velit. 
                            Aliquam vulputate mauris ac lectus sodales rutrum. 
                            Vestibulum sed dui pharetra, viverra diam vel, blandit velit. 
                            Aliquam vulputate mauris ac lectus sodales rutrum. 
                        </p>
                        <a href="{{route('quem-somos')}}" class="btn">LER MAIS</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sobre-2 Area End -->
    <!--? APOIADORES Area Start -->
    <section class="services-area pt-100 pb-150 section-bg" data-background="{{ asset('img/gallery/section_bg01.png') }}">
        <!--? Want To work -->
        <section class="wantToWork-area w-padding">
            <div class="container">
                <div class="row align-items-end justify-content-between">
                    <div class="col-lg-6 col-md-10 col-sm-10">
                        <div class="section-tittle section-tittle2">
                            <span>NOSSOS APOIADORES</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Want To work End -->
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="single-cat text-center mb-50" style="background: #282a3100;">                            
                        <div class="cat-cap">
                            <h5>
                                <a href="https://www.instagram.com/"  target="_blank">
                                    <img src="{{ asset('img/logo/wbbf-circulo.png') }}" alt="" title="APOIADOR XPTO">
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="single-cat text-center mb-50" style="background: #282a3100;">                            
                        <div class="cat-cap">
                            <h5>
                                <a href="https://www.instagram.com/"  target="_blank">
                                    <img src="{{ asset('img/logo/wbbf-circulo.png') }}" alt="" title="APOIADOR XPTO">
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="single-cat text-center mb-50" style="background: #282a3100;">                            
                        <div class="cat-cap">
                            <h5>
                                <a href="https://www.instagram.com/"  target="_blank">
                                    <img src="{{ asset('img/logo/wbbf-circulo.png') }}" alt="" title="APOIADOR XPTO">
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- APOIADORES Area End -->
    
    {{-- <!--? Want To work -->
    <section class="wantToWork-area w-padding" style="padding-bottom: 40px;">
        <div class="container">
            <div class="row align-items-end justify-content-between">
                <div class="col-lg-6 col-md-9 col-sm-9">
                    <div class="section-tittle">
                        <span>CATEGORIAS</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Want To work End -->
    <!--? Team Ara Start -->
    <div class="team-area pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-team mb-30">
                        <div class="team-img">
                            <img src="{{ asset('img/gallery/team1.png') }}" alt="">
                            <div class="team-caption">
                                <h3>
                                    <a href="{{ route('classic-physique') }}">CLASSIC PHYSIQUE</a>
                                </h3>
                                <!-- Blog Social -->
                                <div class="team-social">
                                    <li><a href="{{ route('classic-physique') }}">VER MAIS</a></li>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-team mb-30">
                        <div class="team-img">
                            <img src="{{ asset('img/gallery/team2.png') }}" alt="">
                            <div class="team-caption">
                                <h3>
                                    <a href="{{ route('classic-physique') }}">212 OLYMPIA </a>
                                </h3>
                                <!-- Blog Social -->
                                <div class="team-social">
                                    <li><a href="{{ route('classic-physique') }}">VER MAIS</a></li>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-team mb-30">
                        <div class="team-img">
                            <img src="{{ asset('img/gallery/team3.png') }}" alt="">
                            <div class="team-caption">
                                <h3>
                                    <a href="{{ route('classic-physique') }}">MEN'S PHYSIQUE </a>
                                </h3>
                                <!-- Blog Social -->
                                <div class="team-social">
                                    <li><a href="{{ route('classic-physique') }}">VER MAIS</a></li>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-team mb-30">
                        <div class="team-img">
                            <img src="{{ asset('img/gallery/fisioculturista-mulher1.jpg') }}" alt="">
                            <div class="team-caption">
                                <h3>
                                    <a href="{{ route('classic-physique') }}">FITNESS OLYMPIA</a>
                                </h3>
                                <!-- Blog Social -->
                                <div class="team-social">
                                    <li><a href="{{ route('classic-physique') }}">VER MAIS</a></li>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-team mb-30">
                        <div class="team-img">
                            <img src="{{ asset('img/gallery/mulher3.jpg') }}" alt="">
                            <div class="team-caption">
                                <h3>
                                    <a href="{{ route('classic-physique') }}">FIGURE OLYMPIA </a>
                                </h3>
                                <!-- Blog Social -->
                                <div class="team-social">
                                    <li><a href="{{ route('classic-physique') }}">VER MAIS</a></li>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-team mb-30">
                        <div class="team-img">
                            <img src="{{ asset('img/gallery/mulher5.jpg') }}" alt="">
                            <div class="team-caption">
                                <h3>
                                    <a href="{{ route('classic-physique') }}">BIKINI OLYMPIA</a>
                                </h3>
                                <!-- Blog Social -->
                                <div class="team-social">
                                    <li><a href="{{ route('classic-physique') }}">VER MAIS</a></li>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="padding-top: 5%;">
                <div class="col-lg-4 col-md-6 col-sm-6"></div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <a href="{{route('categorias')}}" class="btn wantToWork-btn f-right" style="width: 100%;">VER TODAS CATEGORIAS</a>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6"></div>                    
            </div>
        </div>
    </div> --}}

    
    <!-- Team Ara End -->
    <!--? Want To work -->
    <section class="wantToWork-area w-padding section-bg" data-background="{{ asset('img/gallery/section_bg02.png') }}">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-6 col-lg-7 col-md-8 col-sm-10">
                    <div class="wantToWork-caption">
                        <h2>
                            Destaque-se no fisiculturismo! 
                            Inscreva-se no curso de arbitragem e torne-se um especialista.
                        </h2>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-3">
                    <a href="{{route('curso-arbitros')}}" class="btn wantToWork-btn f-right" style="width: 100%;">Saiba mais</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Want To work End -->
        
    <!--? Blog Area Start -->
    <section class="home-blog-area section-padding30">
        <div class="container">
            <!-- Section Tittle -->
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9 col-sm-10">
                    <div class="section-tittle text-center mb-100">
                        <span>PRÓXIMOS EVENTOS</span>
                        <!-- <h2>gYM TIPS news fOR YOU THAT selected by us</h2> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="home-blog-single mb-30">
                        <div class="blog-img-cap">
                            <div class="blog-img">
                                <img src="{{ asset('img/gallery/blog1.png') }}" alt="">
                                <!-- Blog date -->
                                <div class="blog-date text-center">
                                    <span>24</span>
                                    <p>Março</p>
                                </div>
                            </div>
                            <div class="blog-cap">
                                {{-- <span>Campeonato Estrantes Premium - Resende Rj</span> --}}
                                <h3><a href="{{ route('campeonatos') }}">Campeonato Estrantes Premium - Resende Rj </a></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="home-blog-single mb-30">
                        <div class="blog-img-cap">
                            <div class="blog-img">
                                <img src="{{ asset('img/gallery/blog2.png') }}" alt="">
                                <!-- Blog date -->
                                <div class="blog-date text-center">
                                    <span>28</span>
                                    <p>Abril</p>
                                </div>
                            </div>
                            <div class="blog-cap">
                                {{-- <span>Campeonato XPTO</span> --}}
                                <h3><a href="{{ route('campeonatos') }}">Campeonato Estadual - <br> Quatis Rj </a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Area End -->

        <!--? Contact form Start -->
        <section class="contact-form-main">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-xl-7 col-lg-7">
                    <div class="form-wrapper">
                        <!--Section Tittle  -->
                        <div class="form-tittle">
                            <div class="row ">
                                <div class="col-lg-11 col-md-10 col-sm-10">
                                    <div class="section-tittle">
                                        <span>CONTATO</span>
                                        <h2>Sinta-se à vontade para entrar em contato conosco!</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Section Tittle  -->

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
        <!-- contact left Img-->
        <div class="from-left d-none d-lg-block">
            <img src="{{ asset('img/gallery/contact_form.png') }}" alt="">
        </div>
    </section>
    <!-- Contact form End -->


    @if($campeonato)
        <div id="pop-up-campeonato" class="modal">
            <div class="modal-content">
                <section style="text-align: center">
                    <span class="close" data-modal-close="#pop-up-campeonato">&times;</span>
                        
                        
                    <h1>DESAFIE SEUS LIMITES NO <br> <strong> {{strtoupper($campeonato->nome)}}</strong>!</h1>

                    <p>
                        Convidamos você a participar do nosso Campeonato, 
                        uma oportunidade única para mostrar sua força, dedicação e paixão pelo esporte.
                    </p>
                    
                    <br>

                    <h1>INSCRIÇÕES ABERTAS!</h1>

                    <div class="submit-info click-aqui">
                        <a href="{{route('inscricao')}}" class="btn">Clique aqui e inscreva-se</a>
                    </div>

                    <br><br>

                    <p>
                        Venha fazer parte deste evento épico. 
                        <br>Mostre ao mundo sua determinação e conquiste o palco do fisiculturismo!
                        <br> Não perca essa chance de brilhar. 
                        <br> Reserve seu lugar hoje mesmo e junte-se a nós para um dia de pura energia e motivação!
                    </p>

                    <p>
                        <strong> Seu desafio começa aqui. Até lá!</strong>
                        <br> Equipe WBBF Rio de Janeiro
                    </p>
                </section>

            </div>
        </div>
    @endif;

    <script>
        $(document).ready(function () {
            $('#pop-up-campeonato').modal({
                fadeDuration: 250
            });
        });
    </script>

    <style>
        .modal-content {
            width: 50%;
            margin: auto;
            margin-top: 10%; /* ajuste conforme necessário */
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 4px;
        }

        .header-transparent{
            background-color: none !important;
        }
        @keyframes blinkAndGrowShrink {
            0%, 50% {
                color: #ff1313;
                transform: scale(1);
            }
            25%, 75% {
                color: #000;
                transform: scale(1.2);
            }
        }

        .click-aqui {
            animation: blinkAndGrowShrink 2s infinite;
            /* Adicione outras propriedades CSS conforme necessário */
        }
    </style>
@endsection
