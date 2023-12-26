@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">      
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" style="overflow-x: auto;">
                    <h4 class="card-title">Extrair Lista do evento</h4>
                    
                    <form class="forms-sample" method="POST" action="{{ route('admin.eventos.inscricoes.extrair-listagem-acao') }}">
                        @csrf
                        <div class="form-group">
                          <label for="nome">Evento</label>
                          <select  class="form-control"name="evento">
                            @foreach($eventos as $evento)
                                <option value="{{$evento->id}}"> {{$evento->nome}}</option>
                            @endforeach
                          </select>
                        </div>
                            
                        <button type="submit" class="btn btn-success btn-fw" id="btnExtrair">EXTRAIR</button>

                    </form>
                   
                </div>
            </div>
        </div>
    </div>

@endsection
