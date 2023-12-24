@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">   
        <div class="col-lg-12 grid-margin stretch-card">
            <button type="button" class="btn btn-danger btn-fw">
                <a class="nav-link"
                    href="{{ route('admin.inscricoes.extrair-listagem') }}">
                    EXTRAIR LISTAGEM POR EVENTO
                </a>
            </button>
        </div>   
        
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample">
                        @csrf
                       
                        <div class="row">
                            <div class="col-lg-11">
                                <div class="form-group">
                                    <label for="evento_id">Filtrar por evento</label>
                                    <select class="form-control" id="evento_id" name="evento_id">
                                        <option value="0"> Todas</option>
                                        @foreach($eventos as $evento)
                                          <option value="{{$evento->id}}"> {{ $evento->nome}}
                                          </option>
                                        @endforeach                                       
                                    </select>
                                </div>
                            </div>
                        
                            <div class="col-lg-1">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div class="input-group" style=" width: 100% !important;    ">
                                      
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" id="btnFiltro" type="button" style=" width: 100% !important;  HEIGHT: 51PX; z-index:0">
                                                FILTRAR
                                            </button>
                                        </div>
                                    </div>
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
                    </p>
                    @if (session('response'))
                    <p class="msg {{ session('response.class') }}">
                        {{ session('response.message') }}
                    </p>
                    @endif
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th> Nome </th>
                                <th> Código </th>
                                <th> Evento </th>
                                <th> Ação </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inscricoes as $inscricao)
                                <tr>
                                    <td class="py-1">
                                       {{$inscricao->nome}}
                                    </td>
                                    <td>
                                        {{$inscricao->codigo}}
                                    </td>

                                    <td>
                                     {{$inscricao->evento->nome}}
                                    </td>
                                    <td class="t-action">

                                        {{-- <a href="{{ route( 'admin.evento.inscricoes.editar', $inscricao->id ) }}"  class="btn-acao btn-edit" title="Editar Pagamento" style="background-color: #03a9f4">
                                            <span class="icon-bg">
                                                <i class="mdi mdi-coin"></i>
                                            </span>                                   
                                        </a>    --}}


                                        <a href="{{ route( 'admin.evento.inscricoes.gerar-pdf', $inscricao->id ) }}"  class="btn-acao btn-edit" title="Gerar PDF" style="background-color: #8e94a9;">
                                            <span class="icon-bg">
                                                <i class="mdi mdi-file-pdf"></i>
                                            </span>                                   
                                        </a>    

                                        {{-- <a href="{{ route( 'admin.evento.inscricoes.detalhes', $inscricao->id ) }}" class="btn-acao btn-edit" title="Ver Detalhes">
                                            <span class="icon-bg">
                                                <i class="mdi mdi-eye"></i>
                                            </span>                                            
                                        </a> --}}
                                      
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
          
          $('#btnFiltro').on('click', function() {
              var evento_id = $("#evento_id").val();

              if(evento_id)
                  window.location.href = "/admin/eventos/inscricoes-evento/"+ evento_id;

          });
      });
    </script>
@endsection
