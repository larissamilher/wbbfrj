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
                                    <label for="tipo">Escolha o tipo de relaório:</label>
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
                                        <option value=""> Selecione</option>
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
                                    <label for="evento_id">Filtrar por Evento</label>
                                    <select class="form-control" id="evento_id" name="evento_id">
                                        <option value=""> Selecione</option>
                                        @foreach($eventos as $evento)
                                          <option value="{{$evento->id}}"> {{ $evento->nome}}
                                          </option>
                                        @endforeach                                       
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">   
                            <div class="col-lg-4">
                            </div>  
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button class="btn btn-secondary" id="btnRelatorio" type="button" style=" width: 100% !important;  HEIGHT: 51PX; z-index:0; background-color: #44ce42; border-color:#44ce42">
                                        GERAR RELATÓRIO EM PDF 
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
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
          
            $('#btnRelatorio').on('click', function() {

                id = null;

                if( $("#tipo").val() == ''){
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: 'Escolha o tipo de relatório'
                    });  
                    
                    return;
                }else{
                    if($("#tipo").val() == 'campeonato'){
                        if($("#campeonato_id").val() == ''){
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: 'Selecione o campeonato que deseja exportar o relatório'
                            });

                            return;
                        }
                        
                        id = $("#campeonato_id").val();
                    }
                    if($("#tipo").val() == 'evento'){

                        if($("#evento_id").val() == ''){
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: 'Selecione o evento que deseja exportar o relatório'
                            });
                            return;
                        }
                        
                        id = $("#evento_id").val();
                    }

                    window.location.href = "/admin/relatorios/gerar-pdf/"+  $("#tipo").val() + '/' + id;

                }
            });
      });
    </script>
@endsection
