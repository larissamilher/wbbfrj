@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">   
        <div class="col-lg-12 grid-margin stretch-card">
            <button type="button" class="btn btn-danger btn-fw">
                <a class="nav-link"
                    href="{{ route('admin.inscricoes.extrair-listagem') }}">
                    EXTRAIR LISTAGEM POR CAMPEONATO
                </a>
            </button>
        </div>   
        
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample">
                        @csrf                       
                        <div class="row">
                            <div class="col-lg-5">
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
                        
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="campeonato_id">Filtrar por Código Inscrição</label>
                                    <input type="text" name="codigo" id="codigo"  class="form-control required">        
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
                    <h4 class="card-title">Inscrições</h4>
                    <span>Inscrições destacadas em verde indicam que o pagamento foi confirmado</span>
                    @if (session('response'))
                    <p class="msg {{ session('response.class') }}">
                        {{ session('response.message') }}
                    </p>
                    @endif
                    <table class="table table-striped" style="margin-top: 2%;">
                        <thead>
                            <tr>
                                <th> Nome </th>
                                <th> Código </th>
                                <th> Evento </th>
                                <th> SubCategoria </th>
                                <th style="width: 18%;"> Ação </th>
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
                                        {{ strlen($inscricao->campeonato->nome) > 20 ? substr($inscricao->campeonato->nome, 0, 20) . '...' : $inscricao->campeonato->nome }}
                                    </td>
                                    <td>
                                        {{ strlen($inscricao->categoria->nome) > 20 ? substr($inscricao->categoria->nome, 0, 20) . '...' : $inscricao->categoria->nome }}
                                    </td>
                                    <td class="t-action">

                                        <a href="{{ route( 'admin.inscricoes.editar', $inscricao->id ) }}"  class="btn-acao btn-edit" title="Editar Pagamento" style="background-color: #03a9f4">
                                            <span class="icon-bg">
                                                <i class="mdi mdi-coin"></i>
                                            </span>                                   
                                        </a>   

                                        <a href="{{ route( 'admin.inscricoes.add-peso', $inscricao->id ) }}" class="btn-acao btn-edit" title="Adicionar Peso e Número" style="background-color: #44ce42">
                                            <span class="icon-bg">
                                                <i class="mdi mdi-weight"></i>
                                            </span>                                            
                                        </a>

                                        <a href="{{ route( 'admin.inscricoes.gerar-pdf', $inscricao->id ) }}"  class="btn-acao btn-edit" title="Gerar PDF" style="background-color: #8e94a9;">
                                            <span class="icon-bg">
                                                <i class="mdi mdi-file-pdf"></i>
                                            </span>                                   
                                        </a>    

                                        <a href="{{ route( 'admin.inscricoes.detalhes', $inscricao->id ) }}" class="btn-acao btn-edit" title="Ver Detalhes">
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
        $(document).ready(function() {
          
          $('#btnFiltro').on('click', function() {
              var campeonato_id = $("#campeonato_id").val();
              var codigo = $("#codigo").val();

              if(campeonato_id)
                  window.location.href = "/admin/inscricoes-campeonatos/"+ campeonato_id + '/' + codigo.replace('/', "-");

          });
      });
    </script>
@endsection
