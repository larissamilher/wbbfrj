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

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <label for="rg">RG</label>
                                <input type="text" name="rg" id="rg"disabled class="form-control required"  value="{{$atleta->rg}}">
                            </div>
                        </div>     

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="nome">Data de Nascimento </label>
                                <input type="text" class="form-control" disabled value="{{ date("d/m/Y H:m", strtotime( $atleta->data_nascimento))}}">
                            </div>    
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="nome">Email</label>
                                <input type="text" class="form-control" disabled value="{{$atleta->email}}">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                           
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <label for="cep">CEP</label>
                                <input type="text" name="cep" id="cep"disabled class="form-control required" value="{{$atleta->cep}}">
                            </div>
                        </div> 
    
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <input type="text" name="estado" id="estado"disabled class="form-control required"  maxlength="2" value="{{$atleta->estado}}">
    
                            </div>
                        </div>
    
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="cidade">Cidade</label>
                                <input type="text" name="cidade" id="cidade"disabled class="form-control required" value="{{$atleta->cidade}}">
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2">
                            <div class="form-group">
                                <label for="numero">Número</label>
                                <input type="text" name="numero" id="numero"disabled class="form-control required" value="{{$atleta->numero}}">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                      
    
                        <div class="col-lg-5 col-md-5">
                            <div class="form-group">
                                <label for="bairro">Bairro</label>
                                <input type="text" name="bairro" id="bairro"disabled class="form-control required" value="{{$atleta->bairro}}">
                            </div>
                        </div>
    
                      
    
                        <div class="col-lg-7 col-md-7">
                            <div class="form-group">
                                <label for="logradouro">Logradouro</label>
                                <input type="text" name="logradouro" id="logradouro"disabled class="form-control required" value="{{$atleta->logradouro}}">
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
