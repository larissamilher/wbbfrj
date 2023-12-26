@extends('layouts.site')

@section('content')
    
    <section class="wantToWork-area w-padding">
        <div class="container">
            <div class="row align-items-end justify-content-between">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="section-tittle">
                        <span>MEN'S PHYSIQUE</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 categorias" style="text-align: center;">
                    <img src="{{ asset('img/categorias/mens_physique.jpeg') }}" alt="">                  
                </div>    
                
                <div class="col-lg-6 col-md-6 col-sm-6 categorias" style="text-align: center;">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="section-tittle-aux">
                            <span>SUBATEGORIAS</span>
                        </div>
                    </div>
                    <h2>
                        Men's Physique Júnior (16 a 23 anos)	
                    </h2>  
                    <h2>
                        Men's Physique Master ( Acima de 35 anos)	
                    </h2>         
                    <h2>
                        Men's Physique Sênior (23 a 35 anos) Acima de 1,80 cm	
                    </h2>         
                    <h2>
                        Men's Physique Sênior (23 a 35 anos) Até 1,70 cm	
                    </h2>         
                    <h2>
                        Men's Physique Sênior (23 a 35 anos) Até 1,80 cm	
                    </h2>         
                </div>    
            </div>

            {{-- <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 categorias" style="text-align: center;">
                    <img src="{{ asset('img/categorias/mens_physique.jpeg') }}" alt="">                  
                </div>     
            </div> --}}
        </div>
    </section>
           
@endsection