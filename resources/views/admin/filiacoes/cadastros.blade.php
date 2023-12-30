@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">   
        {{-- <div class="col-lg-12 grid-margin stretch-card">
            <button type="button" class="btn btn-danger btn-fw">
                <a class="nav-link"
                    href="{{ route('admin.filiacaos.inscricoes.extrair-listagem') }}">
                    EXTRAIR LISTAGEM POR EVENTO
                </a>
            </button>
        </div>    --}}
        
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample">
                        @csrf
                       
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="filiacao_id">Filtrar por filiacao</label>
                                    <select class="form-control" id="filiacao_id" name="filiacao_id">
                                        <option value="0"> Todas</option>
                                        @foreach($filiacoes as $filiacao)
                                          <option value="{{$filiacao->id}}"> {{ $filiacao->nome}}
                                          </option>
                                        @endforeach                                       
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="campeonato_id">Filtrar por Código</label>
                                    <input type="text" name="codigo" id="codigo"  class="form-control required">        
                                </div>
                            </div>
                        
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" id="btnFiltro" type="button" style=" width: 100% !important;  HEIGHT: 51PX; z-index:0">
                                            FILTRAR
                                        </button>
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
                    <h4 class="card-title">Filiações</h4>
                    <span>Filiação sem código indicam que não foram concluídas</span> <br>
                    <span>Filiação destacadas em verde indicam que o pagamento foi confirmado</span>
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
                            <tr @if($inscricao->status_pagamento == 'CONFIRMED' || $inscricao->status_pagamento == 'RECEIVED') style="background-color: #44ce4236;" @endif>
                                    <td class="py-1">
                                       {{$inscricao->atleta->nome}}
                                    </td>
                                    <td>
                                        {{$inscricao->codigo}}
                                    </td>

                                    <td>
                                     {{$inscricao->filiacao->nome}}
                                    </td>
                                    <td class="t-action">

                                        {{-- <a href="{{ route( 'admin.filiacao.inscricoes.editar', $inscricao->id ) }}"  class="btn-acao btn-edit" title="Editar Pagamento" style="background-color: #03a9f4">
                                            <span class="icon-bg">
                                                <i class="mdi mdi-coin"></i>
                                            </span>                                   
                                        </a>    --}}

{{-- 
                                        <a href="{{ route( 'admin.filiacao.inscricoes.gerar-pdf', $inscricao->id ) }}"  class="btn-acao btn-edit" title="Gerar PDF" style="background-color: #8e94a9;">
                                            <span class="icon-bg">
                                                <i class="mdi mdi-file-pdf"></i>
                                            </span>                                   
                                        </a>     --}}

                                        {{-- <a href="{{ route( 'admin.filiacao.inscricoes.detalhes', $inscricao->id ) }}" class="btn-acao btn-edit" title="Ver Detalhes">
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
              var filiacao_id = $("#filiacao_id").val();
              var codigo = $("#codigo").val();
              
              if(filiacao_id)
                  window.location.href = "/admin/filiacao/cadastros/"+ filiacao_id+ '/' + codigo.replace('/', "-");

          });
      });
    </script>
@endsection
