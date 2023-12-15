@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
      
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Cadastrar Campeonato</h4>
            {{-- <p class="card-description"> Basic form elements </p> --}}
            <form class="forms-sample">
              
              <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
              </div>
              
              <div class="form-group">
                <label for="data_inicio_inscricoes">Data do Início das incrições</label>
                <input type="date" class="form-control" id="data_inicio_inscricoes" name="data_inicio_inscricoes" placeholder="Email">
              </div>
              <div class="form-group">
                <label for="data_final_inscricoes">Data Final das incrições</label>
                <input type="date" class="form-control" id="data_final_inscricoes" name="data_final_inscricoes" placeholder="Password">
              </div>
              <div class="form-group">
                <label for="data_campeonato">Data do Campeonato</label>
                <input type="date" class="form-control" id="data_campeonato" name="data_campeonato" placeholder="Password">              
              </div>

              <div class="form-group">
                <label for="valor">valor</label>
                <input type="text" class="form-control" id="valor" name="valor" placeholder="R$ 00,00">               
              </div>         
             
              <button type="button" class="btn btn-danger btn-fw" style="margin-right: 2%;">CANCELAR</button>
              <button type="submit" class="btn btn-success btn-fw">ADICONAR</button>
            </form>
          </div>
        </div>
      </div>

    </div>

@endsection



