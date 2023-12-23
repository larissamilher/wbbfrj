@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <button type="button" class="btn btn-danger btn-fw"><a class="nav-link"
                    href="{{ route('admin.subcategoria.novo') }}">ADICONAR SUBCATEGORIA</a></button>
        </div>

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('admin.subcategoria.store') }}" method="POST">
                        @csrf
                       
                        <div class="row">
                            <div class="col-lg-11">
                                <div class="form-group">
                                    <label for="data_inicio_inscricoes">Filtrar por Categoria</label>
                                    <select class="form-control" id="categoria_id" name="categoria_id">
                                        <option value="0"> Todas
                                        @foreach($categorias as $categoria)
                                          <option value="{{$categoria->id}}" @if (isset($subcategoria->categoria_id) && $subcategoria->categoria_id == $categoria->id) selected @endif> {{ $categoria->nome}}
                                          </option>
                                        @endforeach                                       
                                    </select>
                                </div>
                            </div>
                        
                            <div class="col-lg-1">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div class="input-group" style=" width: 100% !important;    ">
                                      
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" id="btnFiltro" type="button" style=" width: 100% !important;  HEIGHT: 51PX;">
                                                FILTRAR
                                            </button>
                                        </div>
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
                                        <a href="{{ route( 'admin.subcategoria.edit', $subcategoria->id ) }}" class="btn-acao btn-edit" style="">
                                            <span class="icon-bg">
                                                <i class="mdi mdi-plus"></i>
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

    <script>
         $(document).ready(function() {
          
            $('#btnFiltro').on('click', function() {
                var categoriaSelecionada = $("#categoria_id").val();

                if(categoriaSelecionada)
                    window.location.href = "/admin/subcategories/"+ categoriaSelecionada;

            });
        });
    </script>

@endsection
