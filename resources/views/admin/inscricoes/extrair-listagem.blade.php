@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">      
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" style="overflow-x: auto;">
                    <h4 class="card-title">Extrair Lista do evento</h4>
                    
                    <form class="forms-sample">
              
                        <div class="form-group">
                          <label for="nome">Evento</label>
                          <select  class="form-control"id="campeonato">
                            @foreach($campeonatos as $campeonato)
                                <option value="{{$campeonato->id}}"> {{$campeonato->nome}}</option>
                            @endforeach
                          </select>
                        </div>
                            
                        <button type="button" class="btn btn-success btn-fw" id="btnExtrair">EXTRAIR</button>

                    </form>
                   
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#btnExtrair').on('click',function() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "extrair-listagem-acao/"+ $("#campeonato").val(),
                    type: 'GET',    
                    success: function (response) {
                       
                        if (response.success) {   
                           
                        }  
                        
                    }
                });
            });
        });

    </script>
@endsection
