@extends('layouts.site')

@section('content')
    
    <section class="wantToWork-area w-padding">
        <div class="container">
            <div class="row align-items-end justify-content-between">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="section-tittle">
                        <span>SUPER BODY</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 categorias" style="text-align: center;">
                    <img src="{{ asset('img/categorias/super_body.jpeg') }}" alt="">                  
                </div>    
                
                <div class="col-lg-6 col-md-6 col-sm-6 categorias" style="text-align: center;">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="section-tittle-aux">
                            <span>SUBATEGORIAS</span>
                        </div>
                    </div>
                    <h2>
                        Super Body Júnior (16 a 23 anos)	
                    </h2>  
                    <h2>
                        Super Body Master ( Acima de 35 anos)	
                    </h2>         
                    <h2>
                        Super Body Sênior (23 a 35 anos) Acima 1,80 cm	
                    </h2>         
                    <h2>
                        Super Body Sênior (23 a 35 anos) Até 1,70 cm	
                    </h2>         
                    <h2>
                        Super Body Sênior (23 a 35 anos) Até 1,80 cm	
                    </h2>         
                </div>    
            </div>

{{-- 
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 categorias" style="text-align: center;">
                    <img src="{{ asset('img/categorias/super_body.jpeg') }}" alt="">                  
                </div>     
            </div> --}}
        </div>
    </section>
           
@endsection