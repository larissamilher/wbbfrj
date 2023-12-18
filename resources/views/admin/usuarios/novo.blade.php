@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
      
      @if(isset($response))
        <p class="msg {{$response['class']}}">{{$response['message']}}</p>
      @endif

      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Cadastrar Usuário</h4>

            {{-- <p class="card-description"> Basic form elements </p> --}}
            <form class="forms-sample" action="{{ route('admin.usuario.store') }}"  method="POST" >
              @csrf
              <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nonameme" name="name" placeholder="Nome">
              </div>
              
              <div class="form-group">
                <label for="data_inicio_inscricoes">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="exemplo@exemplo.com">           
              </div>

              <div class="form-group">
                <label for="data_inicio_inscricoes">Permissão para cadastrar outro usuário</label>
                <select class="form-control" id="permissao_create_user" name="permissao_create_user">
                  <option value="1">Sim</option>
                  <option value="0" selected>Não</option>
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



