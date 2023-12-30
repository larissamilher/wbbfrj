<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>WBBFRJ - ADMIN</title>
    <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.base.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
 
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

  </head>
  <body>
    <div class="container-scroller">
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          {{-- <a class="navbar-brand brand-logo" href="index.html"><img src="{{ asset('img/logo/wbbf-circulo.png') }}" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset('img/logo/wbbf-circulo.png') }} " alt="logo" /></a> --}}
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
            <ul class="navbar-nav navbar-nav-right">
           
            <li class="nav-item nav-profile dropdown">
              {{-- <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false"> --}}
               
                <div class="nav-profile-text">
                  <p class="mb-1 text-black"> {{ auth()->user()->name }}</p>
                </div>
              {{-- </a> --}}
              {{-- <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="profileDropdown" data-x-placement="bottom-end">
                <div class="p-3 text-center bg-primary">
                  <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ asset('admin/images/faces/face28.png') }}" alt="">
                </div>
                <div class="p-2">
                  <h5 class="dropdown-header text-uppercase ps-2 text-dark">User Options</h5>
                 
                  <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
                    <span>Profile</span>                   
                  </a>
                 
                  <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
                    <span>Log Out</span>
                    <i class="mdi mdi-logout ms-1"></i>
                  </a>
                </div>
              </div> --}}
            </li>          
            
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            {{-- <li class="nav-item nav-category">Main</li> --}}
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                <span class="menu-title">Painel Adminstrativo </span>
              </a>
            </li>
           
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.categorias') }}">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Categorias</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.subcategorias') }}">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">SubCategorias</span>
              </a>
            </li>        

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#campeonatos" aria-expanded="false" aria-controls="campeonatos">
                <span class="icon-bg"><i class="mdi mdi-format-list-bulleted menu-icon"></i></span>
                <span class="menu-title">Campeonatos</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="campeonatos">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.campeonatos') }}">                      
                      <span class="menu-title">Todos</span>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.campeonato.novo') }}">                      
                      <span class="menu-title">Novo</span>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.inscricoes') }}">                      
                      <span class="menu-title">Inscrições</span>
                    </a>
                  </li>

                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#atletas" aria-expanded="false" aria-controls="atletas">
                <span class="icon-bg"><i class="mdi mdi-format-list-bulleted menu-icon"></i></span>
                <span class="menu-title">Atletas</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="atletas">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.atletas') }}">      
                      <span class="menu-title">Inscritos</span>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.atletas-nao-inscritos') }}">                      
                      <span class="menu-title">Não inscritos</span>
                    </a>
                  </li>

              
                </ul>
              </div>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#eventos" aria-expanded="false" aria-controls="eventos">
                <span class="icon-bg"><i class="mdi mdi-format-list-bulleted menu-icon"></i></span>
                <span class="menu-title">Eventos</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="eventos">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.eventos') }}">                      
                      <span class="menu-title">Todos</span>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.evento.novo') }}">                      
                      <span class="menu-title">Novo</span>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.evento.inscricoes') }}">                      
                      <span class="menu-title">Compras</span>
                    </a>
                  </li>

                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#filiacao" aria-expanded="false" aria-controls="filiacao">
                <span class="icon-bg"><i class="mdi mdi-format-list-bulleted menu-icon"></i></span>
                <span class="menu-title">Filiação</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="filiacao">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.filiacao') }}">                      
                      <span class="menu-title">Todas</span>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.filiacao.novo') }}">                      
                      <span class="menu-title">Nova</span>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.filiacao.cadastros') }}">                      
                      <span class="menu-title">Filiados</span>
                    </a>
                  </li>

                </ul>
              </div>
            </li>

            @if(auth()->user()->permissao_create_user)
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.relatorios') }}">
                  <span class="icon-bg"><i class="mdi mdi-format-list-bulleted menu-icon"></i></span>
                  <span class="menu-title">Relatórios</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.usuarios') }}">
                  <span class="icon-bg"><i class="mdi mdi-format-list-bulleted menu-icon"></i></span>
                  <span class="menu-title">Usuários</span>
                </a>
              </li>
            @endif
            <li class="nav-item sidebar-user-actions">
              <div class="sidebar-user-menu">
                <form action="{{ route('logout') }}" method="post" id="logout-form">
                  @csrf
                  {{-- <button type="submit" class="btn btn-danger btn-fw">
                    Sair
                  </button> --}}
               
                  <a href="#" id="logoutLink" class="nav-link">
                    <i class="mdi mdi-logout menu-icon"></i>
                    <span class="menu-title">Sair</span>
                  </a>

                </form>

               
              </div>
            </li>
          </ul>
        </nav>

        <!-- partial -->
        <div class="main-panel">

            @yield('content')

            @yield('scripts-footer')

          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          
          <footer class="footer">
            <div class="footer-inner-wraper">
              <div class="d-sm-flex justify-content-center justify-content-sm-between py-2">
                {{-- <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com </a>2021</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Only the best <a href="https://www.bootstrapdash.com/" target="_blank"> Bootstrap dashboard </a> templates</span> --}}
              </div>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('admin/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/jquery-circle-progress/js/circle-progress.min.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('admin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('admin/js/misc.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('admin/js/dashboard.js') }}"></script>
    <!-- End custom js for this page -->

    

    <script>
      $(document).ready(function() {
          // Associar ação ao clique no link
          $('#logoutLink').on('click', function(event) {
             $("#logout-form").submit();
          });
      });
  </script>
    
    
  </body>
</html>