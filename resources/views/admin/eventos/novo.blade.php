@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">

        @if (isset($response))
            <p class="msg {{ $response['class'] }}">{{ $response['message'] }}</p>
        @endif

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Cadastrar Evento</h4>
                    {{-- <p class="card-description"> Basic form elements </p> --}}
                    <form class="forms-sample" class="forms-sample" action="{{ route('admin.evento.store') }}"
                        method="POST">
                        @csrf

                        <input type="hidden" class="form-control" id="id" name="id" placeholder="id"
                            value="{{ isset($evento->id) ? $evento->id : '' }}">

                        <div class="row">

                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome"
                                        placeholder="Nome" value="{{ isset($evento->nome) ? $evento->nome : '' }}">
                                </div>

                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="data_inicio_inscricoes">Data do Início das incrições</label>
                                    <input type="text" class="form-control" id="data_inicio_inscricao"
                                        name="data_inicio_inscricao" placeholder=""
                                        value="{{ isset($evento->data_inicio_inscricao) ? date('d/m/Y', strtotime($evento->data_inicio_inscricao)) : '' }}"
                                        onfocus="(this.type='date')" onblur="(this.type='text')" />

                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="data_final_inscricoes">Data Final das incrições</label>
                                    <input type="text" class="form-control" id="data_final_inscricao"
                                        name="data_final_inscricao" placeholder=""
                                        value="{{ isset($evento->data_final_inscricao) ? date('d/m/Y', strtotime($evento->data_final_inscricao)) : '' }}"
                                        onfocus="(this.type='date')" onblur="(this.type='text')" />
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-lg-3">
                              <div class="form-group">
                                <label for="data_evento">Data do Evento</label>
                                <input type="text" class="form-control" id="data_evento" name="data_evento"
                                    placeholder=""
                                    value="{{ isset($evento->data_evento) ? date('d/m/Y', strtotime($evento->data_evento)) : '' }}"
                                    onfocus="(this.type='date')" onblur="(this.type='text')" />
    
                              </div>
                            </div>

                            <div class="col-lg-3">     
                              <div class="form-group">
                                <label for="valor">Valor</label>
                                <input type="text" class="form-control" id="valor" name="valor" placeholder="R$ 00,00"
                                    value="{{ isset($evento->valor) ? str_replace('.', ',', $evento->valor) : '' }}">
                              </div>
                            </div>

                            <div class="col-lg-6">
                              <div class="form-group">
                                <label for="local">Local</label>
                                <input type="text" class="form-control" id="local" name="local" placeholder=" "
                                    value="{{ isset($evento->local) ? $evento->local : '' }}">
                              </div>
                            </div>
                        </div>


                        <div class="row">

                          <div class="col-lg-12">
                            <div class="form-group">
                              <label for="descricao">Descrição</label>
                              <input type="text" class="form-control" id="descricao" name="descricao" placeholder=""
                                  value="{{ isset($evento->descricao) ? $evento->descricao : '' }}">
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
   
    $(document).ready(function() {

        $('#valor').on('change',function() {

            var valorInput = document.getElementById('valor').value;

            valorInput = valorInput.replace(',', '.');
 
            var regex = /^[0-9]+(\.[0-9]{1,2})?$/;

            if (!regex.test(valorInput)) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: 'Por favor, insira um valor numérico válido.'
                });
                $('#valor').val('');
                return;
            }
            return;
        });
    });
</script>
