@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <button type="button" class="btn btn-danger btn-fw"><a class="nav-link"
                    href="{{ route('admin.evento.novo') }}">ADICONAR EVENTO</a></button>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" style="overflow-x: auto;">
                    <h4 class="card-title">Evento</h4>
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
                                <th> Inicio Inscrições </th>
                                <th> Final Inscrições </th>
                                <th> Evento </th>
                                <th> Valor </th>
                                <th> Ação </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($eventos as $evento)
                                <tr>
                                    <td class="py-1">
                                        {{$evento->nome}}
                                    </td>
                                    <td>
                                      {{ date("d/m/Y", strtotime( $evento->data_inicio_inscricao))}}
                                    </td>
                                    <td>
                                      {{ date("d/m/Y", strtotime( $evento->data_final_inscricao))}}
                                    </td>
                                    <td> 
                                      {{ date("d/m/Y", strtotime( $evento->data_evento))}}
                                    </td>
                                    <td> R$ {{  number_format( $evento->valor, 2, ',', '.')}}</td>

                                    <td class="t-action">
                                        <a href="{{ route( 'admin.evento.edit', $evento->id ) }}" class="btn-acao btn-edit" style="">
                                            <span class="icon-bg">
                                                <i class="mdi mdi-lead-pencil"></i>
                                            </span>                                            
                                        </a>
                                        <a href="{{ route( 'admin.evento.delete', $evento->id ) }}" onclick="return confirm('Tem certeza que deseja excluir?')" class="btn-acao btn-delete">
                                            <span class="icon-bg">
                                                <i class="mdi mdi-delete"></i>
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
