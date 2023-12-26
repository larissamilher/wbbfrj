@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">   
        @if(isset($response))
            <p class="msg {{$response['class']}}">{{$response['message']}}</p>
        @endif
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" style="overflow-x: auto;">
                    
                    <form class="forms-sample" action="{{ route('admin.inscricoes.add-pagamento-store') }}"  method="POST" >
                        @csrf
          
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="inscricao_id" value="{{$inscricao->id}}">
                                    <label for="nome"><strong>Nome do Atleta:</strong> {{$inscricao->atleta->nome}}</label>
                                    <br>
                                    <label for="nome"><strong>Inscrição de Número:</strong> {{$inscricao->codigo}}</label>
                                </div>    
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="nome">Forma de Pagamento</label>
                                    <select class="form-control" name="forma_pagamento" id="forma_pagamento">
                                        <option value="BOLETO">Boleto</option>
                                        <option value="CREDIT_CARD">Cartão de crédito</option>
                                        <option value="DEBIT_CARD">Cartão de débito</option>
                                        <option value="DINHEIRO">Dinheiro</option>
                                        <option value="PIX">Pix</option>
                                        <option value="BANK_TRANFER">Transferência bancária</option>
                                    </select>
                                </div>    
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="nome">Status Pagamento</label>
                                    <select class="form-control" name="status_pagamento" id="status_pagamento">
                                        <option value="CONFIRMED">Pago</option>
                                        <option value="RECUSED">Recusado</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="nome">Valor</label>
                                    <input type="text" class="form-control" name="valor" value="">
                                </div>
                            </div>

                            <div class="form-check form-check-flat form-check-primary">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="convidado"> Este atleta é um convidado <i class="input-helper"></i></label>
                              </div>

                            <div class="col-lg-3">
                                <label for="nome"></label>
                                <button type="submit" class="btn btn-success btn-fw" style="width: 100%;height: 50px;">
                                    SALVAR
                                </button>
                            </div>
                        </div>                       
                      </form>
                </div>
            </div>
        </div>
    </div>
@endsection
