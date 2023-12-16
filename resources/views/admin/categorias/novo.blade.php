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
              <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
              </div>
              
              <div class="form-group">
                <label for="data_inicio_inscricoes">Gênero</label>
                <select class="form-control" id="genero" name="genero">
                  <option value="m">Masculino</option>
                  <option value="f">Feminino</option>
                </select>              
              </div>

              <div class="form-group">
                <label for="data_inicio_inscricoes">ativa</label>
                <select class="form-control" id="ativa" name="ativa">
                  <option value="1">Sim</option>
                  <option value="0">Não</option>
                </select>              
              </div>
             
              <button type="button" class="btn btn-danger btn-fw" style="margin-right: 2%;">CANCELAR</button>
              <button type="submit" class="btn btn-success btn-fw">ADICONAR</button>
            </form>
          </div>
        </div>
      </div>

    </div>

@endsection



