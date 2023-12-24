@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" style="overflow-x: auto;">
                    <h4 class="card-title">Detalhe atleta</h4>
                    
                  
                   
                </div>
            </div>
        </div>

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                
                <div class="card-body" style="overflow-x: auto;">
                    
                    <div class="row">
                        <h3 for="nome" style="margin: 2% 0;">Dados Cadastrais</h3>
                    </div>

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" disabled value="{{$atleta->nome}}">
                            </div>    
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nome">Telefone</label>
                                <input type="text" class="form-control" disabled value="{{$atleta->celular}}">
                            </div>    
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="nome">CPF </label>
                                <input type="text" class="form-control" disabled value="{{$atleta->cpf}}">
                            </div>    
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="nome">Data de Nascimento </label>
                                <input type="text" class="form-control" disabled value="{{ date("d/m/Y H:m", strtotime( $atleta->data_nascimento))}}">
                            </div>    
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nome">Email</label>
                                <input type="text" class="form-control" disabled value="{{$atleta->email}}">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="academia_coach">Academia/Coach </label>
                                <input type="text" class="form-control" disabled value="{{$atleta->academia_coach}}">
                              </div>
                        </div>
                   
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="autorizacao_uso_imagem">Autorizo o uso da minha imagem: {{($atleta->autorizacao_uso_imagem)? 'Sim' : 'Não'}} </label>
                              </div>
                        </div>                       
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                
                <div class="card-body" style="overflow-x: auto;">
                    
                    <div class="row">
                        <h3 for="nome" style="margin: 2% 0;">Histórico de Inscrições</h3>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th> Código </th>
                                <th> Evento </th>
                                <th> SubCategoria </th>
                                <th> Pagamento </th>
                                <th> Data </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inscricoes as $inscricao)
                                <tr>
                                  
                                    <td>
                                        {{$inscricao->codigo}}
                                    </td>

                                    <td>
                                     {{$inscricao->campeonato->nome}}
                                    </td>
                                    <td>
                                     {{$inscricao->categoria->nome}}
                                    </td>

                                    <td>
                                        {{$inscricao->status_pagamento}}
                                    </td>

                                    <td>
                                        {{ date("d/m/Y", strtotime( $inscricao->created_at))}}
                                    </td>
                                   
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
