<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
   
    <!-- Scripts -->
    @stack('scripts-header')


    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> WBBF - RJ </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gijgo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animated-headline.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.css') }}">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
</head>
<body id="to-top">
     <!-- ? Preloader Start -->
     <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{ asset('img/logo/wbbf-circulo.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!--? Header Start -->
        <div class="header-area header-transparent" style="background-color: #000; ">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2 col-md-1">
                            <div class="logo">
                                <a href="{{ route('home') }}"><img src="{{ asset('img/logo/wbbf-circulo.png') }}" alt="" style="max-width: 60px;"></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-10">
                            <div class="menu-main d-flex align-items-center justify-content-end">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="{{ route('home') }}">Início</a></li>
                                            <li><a href="{{ route('categorias') }}">Categorias</a></li>
                                            {{-- <li>
                                                <a href="{{ route('quem-somos') }}">Quem Somos</a>
                                                <ul class="submenu">
                                                    <li><a href="{{ route('comissao') }}">Comissão Diretiva</a></li>
                                                </ul>
                                            </li> --}}
                                            {{-- <li><a href="{{ route('filiacao') }}">Filiação</a></li> --}}
                                            <li>
                                                <a href="{{ route('campeonatos') }}">Campeonatos</a>
                                                <ul class="submenu">
                                                    <li><a href="{{ route('calendario') }}">Calendário</a></li>
                                                    {{-- <li><a href="{{ route('como-competir') }}">Como competir na WBBF</a></li> --}}
                                                    {{-- <li><a href="{{ route('backstage-anual') }}">Backstage Anual</a></li> --}}
                                                    <li><a href="{{ route('inscricao') }}">Inscrições</a></li>
                                                    {{-- <li>
                                                        <a href="#">Resultados</a>
                                                        <ul class="submenu">
                                                            <li><a href="{{ route('resultado-2023') }}">2023</a></li>
                                                        </ul>
                                                    </li> --}}
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#">Educação</a>
                                                <ul class="submenu">
                                                    <li><a href="{{ route('curso-arbitros') }}">Curso Formação de Árbitros</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="{{ route('contato') }}">Contato</a></li>
                                            <li><a href="{{ route('login') }}">Acessar</a></li>
                                        </ul>

                                    </nav>
                                </div>
                               
                            </div>
                        </div>   
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
    <main>

        @yield('content')

        @yield('scripts-footer')

    </main>

    <footer>
        <!--? Footer Start-->
        <div class="footer-area section-bg" data-background="{{ asset('img/gallery/section_bg03.png') }}">
            <div class="container">
                <div class="footer-top footer-padding">
                    <!-- Footer Menu -->
                    <div class="row d-flex justify-content-between">
                        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>WBBF</h4>
                                    <ul>
                                        <li><a href="{{ route('quem-somos') }}">Quem Somos</a></li>
                                        <li><a href="{{ route('contato') }}">Contato</a></li>
                                        <li><a href="{{ route('curso-arbitros') }}"> Curso Formação de Árbitros </a></li>
                                        <li><a href="{{ route('categorias') }}"> Categorias </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>SERVIÇOS</h4>
                                    <ul>
                                        <li><a href="{{ route('curso-arbitros') }}">Destaque-se no fisiculturismo! Inscreva-se no curso de arbitragem e torne-se um especialista.
                                        </a></li>
                                        {{-- <li><a href="#">Travel Insurance</a></li>
                                        <li><a href="#"> Car Insurance</a></li>
                                        <li><a href="#"> Business Insurance</a></li>
                                        <li><a href="#"> Heal Insurance</a></li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <!-- logo -->
                                <div class="footer-logo">
                                    <a href="{{ route('home') }}"><img src="{{ asset('img/logo/wbbf.png') }}" alt=""></a>
                                </div>
                                <div class="footer-tittle">
                                    <div class="footer-pera">
                                        <p class="info1">WBBF RIO DE JANEIRO.</p>
                                    </div>
                                </div>
                                <!-- Footer Social -->
                                <div class="footer-social ">
                                    <a href="https://www.facebook.com/sai4ull"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->
    </footer>
    <!-- Scroll Up -->
    <div id="back-top" >
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>
    
    <script src="{{ asset('js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Jquery Mobile Menu -->
    <script src="{{ asset('js/jquery.slicknav.min.js') }}"></script>

    <!-- Jquery Slick, Owl-Carousel Plugins -->
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <!-- One Page, Animated-HeadLine -->
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/animated.headline.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>

    <!-- Date Picker -->
    <script src="{{ asset('js/gijgo.min.js') }}"></script>
    <!-- Nice-select, sticky -->
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/jquery.sticky.js') }}"></script>

    <!-- counter, waypoint, Hover Direction -->
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('js/hover-direction-snake.min.js') }}"></script>

    <!-- contact js -->
    <script src="{{ asset('js/contact.js') }}"></script>
    <script src="{{ asset('js/jquery.form.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/mail-script.js') }}"></script>
    <script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>
</html>
