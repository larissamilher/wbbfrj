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
                                <th> CPF </th>
                                <th> Evento </th>
                                <th> Categoria </th>
                                <th> Ação </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inscricoes as $inscricao)
                                <tr>
                                    <td class="py-1">
                                       {{$inscricao->atleta->nome}}
                                    </td>
                                    <td>
                                        {{$inscricao->atleta->cpf}}
                                    </td>

                                    <td>
                                     {{$inscricao->campeonato->nome}}
                                    </td>
                                    <td>
                                     {{$inscricao->categoria->nome}}
                                    </td>
                                    <td class="t-action">

                                        <a href="{{ route( 'admin.inscricoes.gerar-pdf', $inscricao->id ) }}"  class="btn-acao btn-edit" title="Gerar PDF" >
                                            <span class="icon-bg">
                                                <i class="mdi mdi-file-pdf"></i>
                                            </span>                                   
                                        </a>    

                                        <a href="{{ route( 'admin.inscricoes.detalhes', $inscricao->id ) }}" class="btn-acao btn-edit" title="Ver Detalhes">
                                            <span class="icon-bg">
                                                <i class="mdi mdi-eye"></i>
                                            </span>                                            
                                        </a>
                                        <a href="{{ route( 'admin.inscricoes.add-peso', $inscricao->id ) }}" class="btn-acao btn-edit" title="Adicionar Peso Atleta">
                                            <span class="icon-bg">
                                                <i class="mdi mdi-weight"></i>
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
@endsection
