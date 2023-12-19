@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <button type="button" class="btn btn-danger btn-fw"><a class="nav-link"
                    href="{{ route('admin.usuario.novo') }}">ADICONAR USUÁRIO </a></button>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" style="overflow-x: auto;">
                    <h4 class="card-title">Usuários</h4>
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
                                <th> Email </th>
                                <th> Permissão para Criar usuário </th>
                                <th> Ação </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <td class="py-1">
                                        {{$usuario->name}}
                                    </td>
                                    <td>
                                        {{$usuario->email}}
                                    </td>
                                    <td>
                                        {{($usuario->permissao_create_user ? 'Sim' : 'Não')}}
                                    </td>
                                    <td class="t-action">
                                       
                                        <a href="{{ route( 'admin.usuario.delete', $usuario->id ) }}" onclick="return confirm('Tem certeza que deseja excluir?')" class="btn-acao btn-delete">
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
