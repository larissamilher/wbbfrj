@extends('layouts.site')

@section('content')
    
    <section class="wantToWork-area w-padding">
        <div class="container">
            <div class="row align-items-end justify-content-between">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="section-tittle">
                        <span>BODY BUILDER</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 categorias" style="text-align: center;">
                    <img src="{{ asset('img/categorias/bodybuilder.jpeg') }}" alt="">                  
                </div>    
                
                <div class="col-lg-6 col-md-6 col-sm-6 categorias" style="text-align: center;">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="section-tittle-aux">
                            <span>SUBATEGORIAS</span>
                        </div>
                    </div>
                    <h2>
                        Bodybuilder Júnior (16 a 23 anos)	
                    </h2>  
                    <h2>
                        Bodybuilder Master ( A partir de 35 anos)	
                    </h2>         
                    <h2>
                        Bodybuilder Sênior (23 a 35 anos) Acima de 90kg
                    </h2>         
                    <h2>
                        Bodybuilder Sênior (23 a 35 anos) Até 80kg	
                    </h2>         
                    <h2>
                        Bodybuilder Sênior (23 a 35 anos) Até 90kg
                    </h2>         
                </div>    
            </div>
        </div>
    </section>
           
@endsection