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
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th> Nome </th>
                                <th> CPF </th>
                                <th> Email </th>
                                <th> Evento </th>
                                <th> Categoria </th>
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
                                        {{$inscricao->atleta->email}}
                                    </td>

                                    <td>
                                     {{$inscricao->campeonato->nome}}
                                    </td>
                                    <td>
                                     {{$inscricao->categoria->nome}}
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
