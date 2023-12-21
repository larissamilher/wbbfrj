@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">

        @if (isset($response))
            <p class="msg {{ $response['class'] }}">{{ $response['message'] }}</p>
        @endif

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Cadastrar Campeonato</h4>
                    {{-- <p class="card-description"> Basic form elements </p> --}}
                    <form class="forms-sample" class="forms-sample" action="{{ route('admin.campeonato.store') }}"
                        method="POST">
                        @csrf

                        <input type="hidden" class="form-control" id="id" name="id" placeholder="id"
                            value="{{ isset($campeonato->id) ? $campeonato->id : '' }}">

                        <div class="row">

                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome"
                                        placeholder="Nome" value="{{ isset($campeonato->nome) ? $campeonato->nome : '' }}">
                                </div>

                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="data_inicio_inscricoes">Data do Início das incrições</label>
                                    <input type="text" class="form-control" id="data_inicio_inscricao"
                                        name="data_inicio_inscricao" placeholder=""
                                        value="{{ isset($campeonato->data_inicio_inscricao) ? date('d/m/Y', strtotime($campeonato->data_inicio_inscricao)) : '' }}"
                                        onfocus="(this.type='date')" onblur="(this.type='text')" />

                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="data_final_inscricoes">Data Final das incrições</label>
                                    <input type="text" class="form-control" id="data_final_inscricao"
                                        name="data_final_inscricao" placeholder=""
                                        value="{{ isset($campeonato->data_final_inscricao) ? date('d/m/Y', strtotime($campeonato->data_final_inscricao)) : '' }}"
                                        onfocus="(this.type='date')" onblur="(this.type='text')" />
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-lg-3">
                              <div class="form-group">
                                <label for="data_campeonato">Data do Campeonato</label>
                                <input type="text" class="form-control" id="data_campeonato" name="data_campeonato"
                                    placeholder=""
                                    value="{{ isset($campeonato->data_campeonato) ? date('d/m/Y', strtotime($campeonato->data_campeonato)) : '' }}"
                                    onfocus="(this.type='date')" onblur="(this.type='text')" />
    
                              </div>
                            </div>

                            <div class="col-lg-3">     
                              <div class="form-group">
                                <label for="valor">Valor</label>
                                <input type="text" class="form-control" id="valor" name="valor" placeholder="R$ 00,00"
                                    value="{{ isset($campeonato->valor) ? str_replace('.', ',', $campeonato->valor) : '' }}">
                              </div>
                            </div>

                            <div class="col-lg-3">     
                                <div class="form-group">
                                  <label for="valor_dobra">Valor Dobra</label>
                                  <input type="text" class="form-control" id="valor_dobra" name="valor_dobra" placeholder="R$ 00,00"
                                      value="{{ isset($campeonato->valor_dobra) ? str_replace('.', ',', $campeonato->valor_dobra) : '' }}">
                                </div>
                              </div>

                            <div class="col-lg-3">
                              <div class="form-group">
                                <label for="local">Local</label>
                                <input type="text" class="form-control" id="local" name="local" placeholder=" "
                                    value="{{ isset($campeonato->local) ? $campeonato->local : '' }}">
                              </div>
                            </div>

                        </div>


                        <div class="row">

                          <div class="col-lg-12">
                            <div class="form-group">
                              <label for="descricao">Descrição</label>
                              <input type="text" class="form-control" id="descricao" name="descricao" placeholder=""
                                  value="{{ isset($campeonato->descricao) ? $campeonato->descricao : '' }}">
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



<script>
    $(document).ready(function() {
        $('#valor').mask('999,00');
    });
</script>
