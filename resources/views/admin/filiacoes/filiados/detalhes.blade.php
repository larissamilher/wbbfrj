@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">   
         
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" style="overflow-x: auto;">
                    
                    <form class="forms-sample" action="{{ route('admin.categoria.store') }}"  method="POST" >
                        @csrf
          
                        <div class="row">
                            <h3 for="nome" style="margin: 2% 0;">Detalhes do Atleta</h3>
                        </div>

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" disabled value="{{$inscricao->atleta->nome}}">
                                </div>    
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nome">Telefone</label>
                                    <input type="text" class="form-control" disabled value="{{$inscricao->atleta->celular}}">
                                </div>    
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="nome">CPF </label>
                                    <input type="text" class="form-control" disabled value="{{$inscricao->atleta->cpf}}">
                                </div>    
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="nome">Data de Nascimento </label>
                                    <input type="text" class="form-control" disabled value="{{ date("d/m/Y H:m", strtotime( $inscricao->atleta->data_nascimento))}}">
                                </div>    
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nome">Email</label>
                                    <input type="text" class="form-control" disabled value="{{$inscricao->atleta->email}}">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="academia_coach">Academia/Coach </label>
                                    <input type="text" class="form-control" disabled value="{{$inscricao->atleta->academia_coach}}">
                                  </div>
                            </div>
                       
                        </div>

                        <div class="row">

                            <div class="form-check form-check-flat form-check-primary">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="convidado" {{($inscricao->atleta->autorizacao_uso_imagem)? 'checked' : ''}} disabled > Autorizo o uso da minha imagem <i class="input-helper"></i></label>
                              </div>

                        </div>

                    

                        <div class="row">
                            <h3 for="nome" style="margin: 2% 0;">Detalhes da Filiação</h3>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label for="nome">Código</label>
                                    <input type="text" class="form-control" disabled value="{{$inscricao->codigo}}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="data_inicio_inscricoes">Data da inscrição</label>
                                    <input type="text" class="form-control" disabled value="{{ date("d/m/Y H:m", strtotime( $inscricao->created_at))}}">
                                  </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="data_inicio_inscricoes">Filiação</label>
                                    <input type="text" class="form-control" disabled value="{{$inscricao->filiacao->nome}}">
                                  </div>                    
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="data_inicio_inscricoes">Validade</label>
                                    <input type="text" class="form-control" disabled value="{{ date("d/m/Y", strtotime( $inscricao->validade_filiacao))}}">
                                  </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="data_inicio_inscricoes">Status do Pagamento</label>
                                    <input type="text" class="form-control" disabled value="{{$inscricao->status_pagamento}}">
                                  </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="data_inicio_inscricoes">Forma de Pagamento</label>
                                    <input type="text" class="form-control" disabled value="{{$inscricao->billingType}}">
                                  </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-check form-check-flat form-check-primary">
                                    <label for="data_inicio_inscricoes">Foto do Rosto</label>
                                    <br>    
                                    <a href="{{ route( 'admin.filiacao.filiados.download-selfie', $inscricao->id ) }}"title="Clique para fazer o Download">
                                        <img style="width: 200px;border-radius: 5px;box-shadow: rgb(0 0 0 / 30%) 0px 19px 38px, rgb(0 0 0 / 22%) 0px 15px 12px;" src="{{ route('admin.filiacao.filiados.exibir-selfie', ['id' => $inscricao->id]) }}" alt="Imagem">
                                    </a> 
                                 </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-check form-check-flat form-check-primary">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="termo_atleta" {{($inscricao->atleta->termos_atleta)? 'checked' : ''}} disabled > Aceito os termos de atleta após ler atentamente. <i class="input-helper"></i></label>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-lg-3">
                            </div>
                            <div class="col-lg-6">
                                <button type="button" class="btn btn-success btn-fw" style="width: 100%;">
                                    <a href="{{ route( 'admin.inscricoes.gerar-pdf', $inscricao->id ) }}" style="">
                                        GERAR PDF                                       
                                    </a>    
                                </button>
                            </div>
                            <div class="col-lg-3">
                            </div>
                        </div> --}}
                      </form>
                </div>
            </div>
        </div>
    </div>
@endsection
