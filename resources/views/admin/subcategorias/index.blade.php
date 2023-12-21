@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <button type="button" class="btn btn-danger btn-fw"><a class="nav-link"
                    href="{{ route('admin.subcategoria.novo') }}">ADICONAR SUBCATEGORIA</a></button>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" style="overflow-x: auto;">
                    <h4 class="card-title">SubCategorias</h4>
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
                                <th> Categoria </th>
                                <th> Ativa </th>
                                <th> Ação </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subcategorias as $subcategoria)
                                <tr>
                                    <td class="py-1">
                                        {{$subcategoria->nome}}
                                    </td>
                                    <td>
                                      {{$subcategoria->categoria->nome}}
                                    </td>
                                    <td>
                                      @if($subcategoria->ativa) 
                                          Sim 
                                      @else 
                                          Não 
                                      @endif
                                    </td>
                                    <td class="t-action">
                                        <a href="{{ route( 'admin.subcategoria.edit', $subcategoria->id ) }}" class="btn-acao btn-edit" style="">
                                            <span class="icon-bg">
                                                <i class="mdi mdi-lead-pencil"></i>
                                            </span>                                            
                                        </a>
                                        <a href="{{ route( 'admin.subcategoria.delete', $subcategoria->id ) }}" onclick="return confirm('Tem certeza que deseja excluir?')" class="btn-acao btn-delete">
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
