@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" style="overflow-x: auto;">
                    <h4 class="card-title">Atletas</h4>
                    </p>
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
                                <tr>
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
@endsection
