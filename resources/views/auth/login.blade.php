@extends('layouts.site')

@section('content')

<section class="wantToWork-area w-padding">
    <div class="container" style="margin-top: 10%">

        <div class="row">

            <div class="row col-md-4">
            </div>

            <div class="row col-md-6" style="background: #f5f5f5;padding: 2%;padding-left: 4%;">

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
        
       
    </div>
</section>

<style>
.btn-login a, .btn-login a:hover{
    text-decoration: none;
    color: #fff;
}

.form-control {
    background: none;
    height: 60px;
    width: 100%;
    padding: 10px 25px;
    padding-right: 30px;
    border: 0;
    color: #112957;
    font-weight: 500;
    text-transform: capitalize;
    border-radius: 0px;
    border-bottom: 2px solid #e9f0f4;
    font-size: 16px;
}
</style>



@endsection


