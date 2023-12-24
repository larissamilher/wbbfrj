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
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="autorizacao_uso_imagem">Autorizo o uso da minha imagem: {{($inscricao->atleta->autorizacao_uso_imagem)? 'Sim' : 'Não'}} </label>
                                  </div>
                            </div>
                       
                        </div>

                        <div class="row">
                            <h3 for="nome" style="margin: 2% 0;">Detalhes da Inscrição</h3>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label for="nome">Código da Inscrição</label>
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
                                    <label for="data_inicio_inscricoes">Campeonato</label>
                                    <input type="text" class="form-control" disabled value="{{$inscricao->campeonato->nome}}">
                                  </div>
                    
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="data_inicio_inscricoes">SubCategoria</label>
                                    <input type="text" class="form-control" disabled value="{{$inscricao->categoria->nome}}">
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
                       
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="data_inicio_inscricoes">Peso Atleta</label>
                                    <input type="text" class="form-control" disabled value="{{ $inscricao->peso}}">
                                  </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="numero_atleta">Número do Atleta</label>
                                    <input type="text" class="form-control" disabled value="{{ $inscricao->numero_atleta}}">
                                  </div>
                            </div>
                        </div>
                        
                        <div class="row">
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
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
@endsection
