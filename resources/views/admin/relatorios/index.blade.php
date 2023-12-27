@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">   
     
        
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample">
                        @csrf        
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="tipo">Filtrar por:</label>
                                    <select class="form-control" id="tipo" name="tipo">
                                        <option value=""> Selecione</option>
                                        <option value="campeonato"> Campeonato</option>
                                        <option value="evento"> Evento</option>           
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row div-campeonato" style="display: none">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="campeonato_id">Filtrar por Campeonato</label>
                                    <select class="form-control" id="campeonato_id" name="campeonato_id">
                                        <option value="0"> Todas</option>
                                        @foreach($campeonatos as $campeonato)
                                          <option value="{{$campeonato->id}}"> {{ $campeonato->nome}}
                                          </option>
                                        @endforeach                                       
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row div-evento"  style="display: none">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="campeonato_id">Filtrar por Evento</label>
                                    <select class="form-control" id="campeonato_id" name="campeonato_id">
                                        <option value="0"> Todas</option>
                                        @foreach($campeonatos as $campeonato)
                                          <option value="{{$campeonato->id}}"> {{ $campeonato->nome}}
                                          </option>
                                        @endforeach                                       
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">     
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button class="btn btn-secondary" id="btnFiltro" type="button" style=" width: 100% !important;  HEIGHT: 51PX; z-index:0">
                                        FILTRAR
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" style="overflow-x: auto;">
                    <h4 class="card-title">Inscrições</h4>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $('#tipo').on('change', function() {
                var tipo = $("#tipo").val();
                var targetElement;

                if (tipo == 'campeonato') {
                    $(".div-evento").fadeOut(300, function() {
                        $(".div-campeonato").fadeIn(300);
                    });
                    targetElement = $(".div-campeonato");
                } else {
                    $(".div-campeonato").fadeOut(300, function() {
                        $(".div-evento").fadeIn(300);
                    });
                    targetElement = $(".div-evento");
                }

                if (targetElement.length > 0) {
                    $('html, body').animate({
                        scrollTop: targetElement.offset().top
                    }, 1000);
                }
            });
          
          $('#btnFiltro').on('click', function() {
              var campeonato_id = $("#campeonato_id").val();
              var codigo = $("#codigo").val();

              if(campeonato_id)
                  window.location.href = "/admin/inscricoes-campeonatos/"+ campeonato_id + '/' + codigo.replace('/', "-");

          });
      });
    </script>
@endsection
