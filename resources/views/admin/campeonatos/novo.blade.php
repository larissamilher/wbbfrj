@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
         
      @if(isset($response))
        <p class="msg {{$response['class']}}">{{$response['message']}}</p>
      @endif

      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Cadastrar Campeonato</h4>
            {{-- <p class="card-description"> Basic form elements </p> --}}
            <form class="forms-sample" class="forms-sample" action="{{ route('admin.campeonato.store') }}"  method="POST" >
              @csrf
              <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
              </div>
              
              <div class="form-group">
                <label for="data_inicio_inscricoes">Data do Início das incrições</label>
                <input type="date" class="form-control" id="data_inicio_inscricao" name="data_inicio_inscricao" placeholder="Email">
              </div>
              <div class="form-group">
                <label for="data_final_inscricoes">Data Final das incrições</label>
                <input type="date" class="form-control" id="data_final_inscricao" name="data_final_inscricao" placeholder="Password">
              </div>
              <div class="form-group">
                <label for="data_campeonato">Data do Campeonato</label>
                <input type="date" class="form-control" id="data_campeonato" name="data_campeonato" placeholder="Password">              
              </div>

              <div class="form-group">
                <label for="valor">valor</label>
                <input type="text" class="form-control" id="valor" name="valor" placeholder="R$ 00,00">               
              </div> 
              
              <div class="form-group">
                <label for="local">Local</label>
                <input type="text" class="form-control" id="local" name="local" placeholder="">               
              </div> 

              <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="">               
              </div> 
             
              <button type="button" class="btn btn-danger btn-fw" style="margin-right: 2%;">CANCELAR</button>
              <button type="submit" class="btn btn-success btn-fw">ADICONAR</button>
            </form>
          </div>
        </div>
      </div>

    </div>

@endsection



<script>
   $(document).ready(function() {
        $('#valor').mask('999,00');
    });
</script>