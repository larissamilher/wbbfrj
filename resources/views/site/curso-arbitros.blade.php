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
                <div class="col-lg-12 col-md-12 col-sm-12 categorias" style="text-align: center;">
                    
                    <video height="550" controls>
                        <source src="{{ asset('video/WORKSHOP.mp4') }}" type="video/mp4">
                            WORKSHOP AO FISICULTURISMO
                    </video>
                </div>     
            </div>
        </div>
    </section>
           
@endsection