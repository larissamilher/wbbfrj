
@section('content')
    
<section class="inscricao-form-main">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-xl-3 col-lg-12">
                </div>
                <div class="col-xl-6 col-lg-12">
                    <div class="form-wrapper">
                        <!--Section Tittle  -->
                        <div class="form-tittle">
                            <div class="row "  style=" margin-top: 5%; ">
                                <div class="col-lg-11 col-md-10 col-sm-10">
                                    <div class="section-tittle">
                                        <span>LOGIN</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('login') }}" class="inscricao-form" style="  font-size: 18px;width: 100%;  ">
                            @csrf
                
                            <div class="row">
                
                                <div class="row col-md-12">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                
                            
                            </div>
                
                            <div class="row">
                
                            
                
                                <div class="row col-md-12">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Senha') }}</label>
                
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                
                            
                            </div>
                
                            <div class="row" style="margin-top: 5%;">
                
                            
                                <div class="row col-md-12">
                                    <button type="submit" class="btn btn-primary" style=" width: 80%;margin-left: 10%;">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                
                            
                            </div>
            
                        </form>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-12">
                </div>
            </div>
        </div>
    </section>


@endsection
@extends('layouts.site')





