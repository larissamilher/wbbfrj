@extends('layouts.site')

@section('content')
       
        <section class="wantToWork-area w-padding">
            <div class="container">
                <div class="row align-items-end justify-content-between">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="section-tittle">
                            <span>Categorias</span>
                            <h2 style="text-align: center;">masculino</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!--? Gallery Area Start -->
        <div class="gallery-area">
            <div class="container-fluid p-0 fix">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="box snake mb-30">
                            <div class="gallery-img small-img" style="background-image: url({{ asset('img/gallery/team1.png') }});"></div>
                            <div class="overlay">
                                <div class="overlay-content">
                                    <a href="{{ route('categoria.bodybuilder') }}"><i class="ti-plus"></i></a>
                                    <h3>BODY BUILDER</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="box snake mb-30">
                            <div class="gallery-img small-img" style="background-image: url({{ asset('img/gallery/team2.png') }});"></div>
                            <div class="overlay">
                                <div class="overlay-content">
                                    <a href="{{ route('categoria.classic') }}"><i class="ti-plus"></i></a>
                                    <h3>CLASSIC</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="box snake mb-30">
                            <div class="gallery-img small-img" style="background-image: url({{ asset('img/gallery/team3.png') }});"></div>
                            <div class="overlay">
                                <div class="overlay-content">
                                    <a href="{{ route('categoria.mens_physique') }}"><i class="ti-plus"></i></a>
                                    <h3>MEN'S PHYSIQUE</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="box snake mb-30">
                            <div class="gallery-img small-img" style="background-image: url({{ asset('img/gallery/team1.png') }});"></div>
                            <div class="overlay">
                                <div class="overlay-content">
                                    <a href="{{ route('categoria.summer_shape') }}"><i class="ti-plus"></i></a>
                                    <h3>SUMMER SHAPE</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="box snake mb-30">
                            <div class="gallery-img small-img" style="background-image: url({{ asset('img/gallery/team2.png') }});"></div>
                            <div class="overlay">
                                <div class="overlay-content">
                                    <a href="{{ route('categoria.super_body') }}"><i class="ti-plus"></i></a>
                                    <h3>SUPER BODY</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="box snake mb-30">
                            <div class="gallery-img small-img" style="background-image: url({{ asset('img/gallery/team3.png') }});"></div>
                            <div class="overlay">
                                <div class="overlay-content">
                                    <a href="{{ route('categoria.up_shape') }}"><i class="ti-plus"></i></a>
                                    <h3>UP SHAPE</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gallery Area End -->
       
        <section class="wantToWork-area w-padding">
            <div class="container">
                <div class="row align-items-end justify-content-between">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="section-tittle">
                            <h2 style="text-align: center;">feminina</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>

         <!--? Gallery Area Start -->
         <div class="gallery-area">
            <div class="container-fluid p-0 fix">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="box snake mb-30">
                            <div class="gallery-img small-img" style="background-image: url({{ asset('img/gallery/fisioculturista-mulher1.jpg') }});"></div>
                            <div class="overlay">
                                <div class="overlay-content">
                                    <a href="{{ route('categoria.bikini') }}"><i class="ti-plus"></i></a>
                                    <h3>BIKINI</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="box snake mb-30">
                            <div class="gallery-img small-img" style="background-image: url({{ asset('img/gallery/mulher3.jpg') }});"></div>
                            <div class="overlay">
                                <div class="overlay-content">
                                    <a href="{{ route('categoria.super_model') }}"><i class="ti-plus"></i></a>
                                    <h3>SUPER MODEL</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="box snake mb-30">
                            <div class="gallery-img small-img" style="background-image: url({{ asset('img/gallery/mulher5.jpg') }});"></div>
                            <div class="overlay">
                                <div class="overlay-content">
                                    <a href="{{ route('categoria.wellness') }}"><i class="ti-plus"></i></a>
                                    <h3>WELLNESS</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gallery Area End -->
   
@endsection