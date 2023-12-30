@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">

        @if (isset($response))
            <p class="msg {{ $response['class'] }}">{{ $response['message'] }}</p>
        @endif

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Cadastrar Filiação</h4>
                    {{-- <p class="card-description"> Basic form elements </p> --}}
                    <form class="forms-sample" class="forms-sample" action="{{ route('admin.filiacao.store') }}"
                        method="POST">
                        @csrf

                        <input type="hidden" class="form-control" id="id" name="id" placeholder="id"
                            value="{{ isset($filiacao->id) ? $filiacao->id : '' }}">

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome"
                                        placeholder="Nome" value="{{ isset($filiacao->nome) ? $filiacao->nome : '' }}">
                                </div>

                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="data_inicio_inscricoes">Data do Início das incrições</label>
                                    <input type="text" class="form-control" id="data_inicio_inscricao"
                                        name="data_inicio_inscricao" placeholder=""
                                        value="{{ isset($filiacao->data_inicio_inscricao) ? date('d/m/Y', strtotime($filiacao->data_inicio_inscricao)) : '' }}"
                                        onfocus="(this.type='date')" onblur="(this.type='text')" />

                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="data_final_inscricoes">Data Final das incrições</label>
                                    <input type="text" class="form-control" id="data_final_inscricao"
                                        name="data_final_inscricao" placeholder=""
                                        value="{{ isset($filiacao->data_final_inscricao) ? date('d/m/Y', strtotime($filiacao->data_final_inscricao)) : '' }}"
                                        onfocus="(this.type='date')" onblur="(this.type='text')" />
                                </div>
                            </div>

                            <div class="col-lg-3">
                              <div class="form-group">
                                <label for="validade">Data do Evento</label>
                                <input type="text" class="form-control" id="validade" name="validade"
                                    placeholder=""
                                    value="{{ isset($filiacao->validade) ? date('d/m/Y', strtotime($filiacao->validade)) : '' }}"
                                    onfocus="(this.type='date')" onblur="(this.type='text')" />
    
                              </div>
                            </div>

                            <div class="col-lg-3">     
                              <div class="form-group">
                                <label for="valor">Valor</label>
                                <input type="text" class="form-control" id="valor" name="valor" placeholder="R$ 00,00"
                                    value="{{ isset($filiacao->valor) ? str_replace('.', ',', $filiacao->valor) : '' }}">
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
