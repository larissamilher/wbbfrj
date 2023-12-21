@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">

        @if (isset($response))
            <p class="msg {{ $response['class'] }}">{{ $response['message'] }}</p>
        @endif

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Cadastrar subcategoria</h4>

                    {{-- <p class="card-description"> Basic form elements </p> --}}
                    <form class="forms-sample" action="{{ route('admin.subcategoria.store') }}" method="POST">
                        @csrf
                        <input type="hidden" class="form-control" id="id" name="id" placeholder="Nome"
                            value="{{ isset($subcategoria->id) ? $subcategoria->id : '' }}">

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome"
                                        placeholder="Nome"
                                        value="{{ isset($subcategoria->nome) ? $subcategoria->nome : '' }}">
                                </div>
                            </div>

                          
                           
                        </div>

                        <div class="row">

                          <div class="col-lg-6">
                            <div class="form-group">
                                <label for="data_inicio_inscricoes">Categoria</label>
                                <select class="form-control" id="categoria_id" name="categoria_id">
                                  @foreach($categorias as $categoria)
                                    <option value="{{$categoria->id}}" @if (isset($subcategoria->categoria_id) && $subcategoria->categoria_id == $categoria->id) selected @endif> {{ $categoria->nome}}
                                    </option>
                                  @endforeach                                       
                                </select>
                            </div>
                          </div>

                          <div class="col-lg-6">
                            <div class="form-group">
                                <label for="data_inicio_inscricoes">ativa</label>
                                <select class="form-control" id="ativa" name="ativa">
                                    <option value="1" @if (isset($subcategoria->ativa) && $subcategoria->ativa == 1) selected @endif>Sim
                                    </option>
                                    <option value="0" @if (isset($subcategoria->ativa) && $subcategoria->ativa == 0) selected @endif>Não
                                    </option>
                                </select>
                            </div>
                        </div>
                        </div>

                        <button type="button" class="btn btn-danger btn-fw" style="margin-right: 2%;">CANCELAR</button>
                        <button type="submit" class="btn btn-success btn-fw">SALVAR</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
