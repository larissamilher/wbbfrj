@extends('layouts.site')

@section('content')
    
    <section class="wantToWork-area w-padding">
        <div class="container">
            <div class="row align-items-end justify-content-between">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="section-tittle">
                        <span>CLASSIC</span>
                    </div>
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 categorias" style="text-align: center;">
                    <img src="{{ asset('img/categorias/classic.jpeg') }}" alt="">                  
                </div>     
            </div> --}}

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 categorias" style="text-align: center;">
                    <img src="{{ asset('img/categorias/classic.jpeg') }}" alt="">                  
                </div>    
                
                <div class="col-lg-6 col-md-6 col-sm-6 categorias" style="text-align: center;">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="section-tittle-aux">
                            <span>SUBATEGORIAS</span>
                        </div>
                    </div>
                    <h2>
                        Classic Júnior (16 a 23 anos) Altura + 10kg	
                    </h2>  
                    <h2>
                        Classic Master ( Acima de 35 anos) Altura + 10kg	
                    </h2>         
                    <h2>
                        Classic Sênior (23 a 35 anos) Acima de 1,80 cm + 10kg	
                    </h2>         
                    <h2>
                        Classic Sênior (23 a 35 anos) Até 1,70 cm + 10kg	
                    </h2>         
                    <h2>
                        Classic Sênior (23 a 35 anos) Até 1,80 cm + 10kg	
                    </h2>         
                </div>    
            </div>
        </div>
    </section>
           
@endsection