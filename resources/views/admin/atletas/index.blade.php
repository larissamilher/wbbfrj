@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample">
                        @csrf                       
                        <div class="row">
                           
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="campeonato_id">Filtrar por CPF</label>
                                    <input type="text" name="cpf" id="cpf"  class="form-control required" value="">        
                                </div>
                            </div>

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
                    <h4 class="card-title">Atletas</h4>
                    {{-- <span>Atletas destacados em vermelho indicam que nunca participaram de nenhum campeonato.</span> --}}
                    
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th> Nome </th>
                                <th> Celular </th>
                                <th> Email </th>
                                <th> CPF </th>
                                <th> Ação </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($atletas as $atleta)                         
                                <tr 
                                {{-- @if(empty($atleta->campeonatos->isEmpty())) style="background-color: #ff222240 !important" @endif --}}
                                >
                                    <td class="py-1">
                                        {{$atleta->nome}}
                                    </td>
                                    <td>
                                      {{ $atleta->celular}}
                                    </td>
                                    <td>
                                      {{ $atleta->email}}
                                    </td>
                                    <td> 
                                      {{ $atleta->cpf}}
                                    </td>
                                    <td class="t-action">

                                        <a href="{{ route( 'admin.atleta.detalhes', $atleta->id ) }}" class="btn-acao btn-edit" title="Ver Detalhes">
                                            <span class="icon-bg">
                                                <i class="mdi mdi-eye"></i>
                                            </span>                                            
                                        </a>
                                      
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

        // $(document).ready(function($) {
        //     $('#cpf').mask('999.999.999-99');
        // });

        $(document).ready(function() {
          
          $('#btnFiltro').on('click', function() {
              var cpf = $("#cpf").val();

              if(cpf)
                  window.location.href = "/admin/atletas/"+ cpf.replace(/[.-]/g, "");

          });
      });
    </script>
@endsection
