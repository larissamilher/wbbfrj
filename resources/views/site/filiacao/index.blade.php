@extends('layouts.site')

@section('content')
       
    <section class="wantToWork-area w-padding">
        <div class="container">
            <div class="row align-items-end justify-content-between">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="section-tittle">
                        <span>Filiação</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2>
                        Para se filiar à WBBF RJ no ano de 2024, clique no botão abaixo. 
                    </h2>                 
                </div>        
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">                  
                    <a href="{{route('filiacao.cadastro')}}" class="btn wantToWork-btn f-right btn-inscreva btn-inscreva"
                    style="margin-right: 33%;">Seja Filiado</a>
                </div>     
            </div>
        </div>
    </section>
    
@endsection  
   