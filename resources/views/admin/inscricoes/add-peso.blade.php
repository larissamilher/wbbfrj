@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">   
        @if(isset($response))
            <p class="msg {{$response['class']}}">{{$response['message']}}</p>
        @endif
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" style="overflow-x: auto;">
                    
                    <form class="forms-sample" action="{{ route('admin.inscricoes.add-peso-store') }}"  method="POST" >
                        @csrf
          
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nome"><strong>Nome do Atleta:</strong> {{$inscricao->atleta->nome}}</label>
                                    <br>
                                    <label for="nome"><strong>Inscrição de Número:</strong> {{$inscricao->codigo}}</label>
                                </div>    
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="nome">Peso</label>
                                    <input type="hidden" class="form-control" name="inscricao_id" value="{{$inscricao->id}}">
                                    <input type="" class="form-control" name="peso" value="{{$inscricao->peso}}">
                                </div>    
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="nome">Número do Atleta</label>
                                    <input type="text" class="form-control" name="numero_atleta" value="{{$inscricao->numero_atleta}}">                                </div>    
                            </div>

                            <div class="col-lg-4">
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
