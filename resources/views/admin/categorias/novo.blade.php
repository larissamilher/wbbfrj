@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
      
      @if(isset($response))
        <p class="msg {{$response['class']}}">{{$response['message']}}</p>
      @endif

      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Cadastrar Categoria</h4>

            {{-- <p class="card-description"> Basic form elements </p> --}}
            <form class="forms-sample" action="{{ route('admin.categoria.store') }}"  method="POST" >
              @csrf
              <input type="hidden" class="form-control" id="id" name="id" placeholder="Nome" value="{{isset($categoria->id) ? $categoria->id : ''}}">

              <div class="row">

                <div class="col-lg-6">
                   <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{isset($categoria->nome) ? $categoria->nome : ''}}">
                  </div>
                </div>

                 <div class="col-lg-3">
                   <div class="form-group">
                <label for="data_inicio_inscricoes">Gênero</label>
                <select class="form-control" id="genero" name="genero">
                    <option value="m" @if(isset($categoria->genero) && $categoria->genero == 'm') selected @endif>Masculino</option>
                    <option value="f" @if(isset($categoria->genero) && $categoria->genero == 'f') selected @endif>Feminino</option>
                </select>
                        
              </div>

                </div>

                 <div class="col-lg-3">

                   <div class="form-group">
                <label for="data_inicio_inscricoes">ativa</label>
                <select class="form-control" id="ativa" name="ativa">
                  <option value="1" @if(isset($categoria->ativa) && $categoria->ativa == 1) selected @endif>Sim</option>
                  <option value="0" @if(isset($categoria->ativa) && $categoria->ativa == 0) selected @endif>Não</option>
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



