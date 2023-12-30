@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <button type="button" class="btn btn-danger btn-fw"><a class="nav-link"
                    href="{{ route('admin.filiacao.novo') }}">ADICONAR FILIAÇÃO</a></button>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" style="overflow-x: auto;">
                    <h4 class="card-title">Filiações</h4>
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
                                <th> Inicio Cadastros </th>
                                <th> Final Cadastros </th>
                                <th> Validade </th>
                                <th> Valor </th>
                                <th> Ação </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($filiacoes as $filiacao)
                                <tr>
                                    <td class="py-1">
                                        {{$filiacao->nome}}
                                    </td>
                                    <td>
                                      {{ date("d/m/Y", strtotime( $filiacao->data_inicio_inscricao))}}
                                    </td>
                                    <td>
                                      {{ date("d/m/Y", strtotime( $filiacao->data_final_inscricao))}}
                                    </td>
                                    <td> 
                                      {{ date("d/m/Y", strtotime( $filiacao->validade))}}
                                    </td>
                                    <td> R$ {{  number_format( $filiacao->valor, 2, ',', '.')}}</td>

                                    <td class="t-action">
                                        <a href="{{ route( 'admin.filiacao.edit', $filiacao->id ) }}" class="btn-acao btn-edit" style="">
                                            <span class="icon-bg">
                                                <i class="mdi mdi-lead-pencil"></i>
                                            </span>                                            
                                        </a>
                                        <a href="{{ route( 'admin.filiacao.delete', $filiacao->id ) }}" onclick="return confirm('Tem certeza que deseja excluir?')" class="btn-acao btn-delete">
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
