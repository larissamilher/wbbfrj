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
                    <form class="forms-sample">
                        @csrf
                       
                        <div class="row">
                            <div class="col-lg-11">
                                <div class="form-group">
                                    <label for="data_inicio_inscricoes">Filtrar por Categoria</label>
                                    <select class="form-control" id="categoria_id" name="categoria_id">
                                        <option value="0"> Todas</option>
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
                                            <button class="btn btn-secondary" id="btnFiltro" type="button" style=" width: 100% !important;  HEIGHT: 51PX; z-index:0">
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

                                        <a href="{{ route( 'admin.subcategoria.edit', $subcategoria->id ) }}" style="" title="EDITAR">
                                            <button class="btn btn-primary btn-fw" type="button" style="min-width:0;height: 36px;">
                                                <span class="icon-bg">
                                                    <i class="mdi mdi-lead-pencil"></i>
                                                </span>   
                                            </button>                                         
                                        </a>                                      

                                        {{-- <button onclick="openModal({{$subcategoria->id}})" class="btn btn-success btn-fw" id="btnFiltro" type="button" style="min-width:0;height: 36px;" title="ADD A CAMPEONATO">
                                            <span class="icon-bg">
                                                <i class="mdi mdi-plus"></i>
                                            </span>      
                                        </button> --}}
                                    
                                        <a href="{{ route( 'admin.subcategoria.delete', $subcategoria->id ) }}" onclick="return confirm('Tem certeza que deseja excluir?')"  title="DELETAR">
                                            <button class="btn btn-danger btn-fw" type="button" style="min-width:0;height: 36px;">
                                                <span class="icon-bg">
                                                    <i class="mdi mdi-delete"></i>
                                                </span>     
                                            </button>                                           
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

   
    <div id="modalAddSubCategoriaCampeonato">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form class="forms-sample">
                @csrf
               
                <div class="row">
                    <div class="col-lg-10">
                        <div class="form-group">
                            <input type="hidden" name="subcategoria_id" id="subcategoria_id" value="">

                            <label for="campeonato_id">Selecione o Campeonato</label>
                            <select class="form-control" id="campeonato_id" name="campeonato_id">
                                @foreach($campeonatos as $campeonato)
                                  <option value="{{$campeonato->id}}"> {{ $campeonato->nome}}
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
                                    <button class="btn btn-success btn-fw" id="btnAddSubCategoriaCampeonato" type="button" style="    min-width: 0;  width: 100% !important;  HEIGHT: 51PX;">
                                        ADICIONAR
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <style> 
        #modalAddSubCategoriaCampeonato {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color:rgb(0 0 0 / 72%);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

    <script>
         function openModal($subcategoriaId) {
            $("#subcategoria_id").val($subcategoriaId);
            document.getElementById('modalAddSubCategoriaCampeonato').style.display = 'block';
        }

        // Função para fechar o modal
        function closeModal() {
            document.getElementById('modalAddSubCategoriaCampeonato').style.display = 'none';
        }

        // Fechar o modal clicando fora da área do modal
        window.onclick = function (event) {
            var modal = document.getElementById('modalAddSubCategoriaCampeonato');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }

        $(document).ready(function() {
          
            $('#btnFiltro').on('click', function() {
                var categoriaSelecionada = $("#categoria_id").val();

                if(categoriaSelecionada)
                    window.location.href = "/admin/subcategories/"+ categoriaSelecionada;

            });

            $('#btnAddSubCategoriaCampeonato').on('click', function() {
                var campeonatoSelecionado = $("#campeonato_id").val();
                var subCategoriaSelecionada = $("#subcategoria_id").val();

                if(campeonatoSelecionado){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/admin/subcategories/add-campeonato/"+subCategoriaSelecionada +'/'+ campeonatoSelecionado,
                        type: 'GET',    
                        success: function (response) {
                        
                            if (response.success) {   
                              
                                Swal.fire({
                                title: "Bom trabalho!",
                                text: response.message,
                                icon: "success"
                                });
                            } else{
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text:  response.message,
                                });      
                            } 
                            
                        }
                    });
                }

            });
        });
    </script>

@endsection
