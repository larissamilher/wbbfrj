@extends('layouts.site')

@section('content')

    <section class="wantToWork-area w-padding">
        <div class="container">
            <div class="row align-items-end justify-content-between">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="section-tittle">
                        <span>WORKSHOP AO FISICULTURISMO</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 categorias" style="text-align: center;">
                     
                    <video height="550" controls>
                        <source src="{{ asset('video/WORKSHOP.mp4') }}" type="video/mp4">
                            WORKSHOP AO FISICULTURISMO
                    </video>
                </div>    
                
                <div class="col-lg-6 col-md-6 col-sm-6 categorias" style="text-align: center;">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="section-tittle-aux">
                            <span>
                                1º LOTE <strong style="color: black"> R$ 250,00</strong><br>
                                2º LOTE <strong style="color: black"> R$ 270,00</strong><br>
                                3º LOTE <strong style="color: black"> R$ 320,00</strong><br>
                            </span>
                        </div>
                    </div>
                </div>    
            </div>

            {{-- <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 categorias" style="text-align: center;">
                    <img src="{{ asset('img/categorias/bikini.jpeg') }}" alt="">                  
                </div>     
            </div> --}}
        </div>
    </section>
           
@endsection