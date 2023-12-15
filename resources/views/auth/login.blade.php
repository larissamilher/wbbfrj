@extends('layouts.site')

@section('content')

<section class="wantToWork-area w-padding">
    <div class="container" style="margin-top: 10%">
        <form method="POST" action="{{ route('login') }}" class="inscricao-form" style="    font-size: 18px;        ">
            @csrf

            <div class="row">
                <div class="row col-md-4">
                </div>

                <div class="row col-md-5">
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

                <div class="row col-md-4">
                </div>

                <div class="row col-md-5">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Senha') }}</label>

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

             
            </div>
            <div class="row mb-3">
                {{-- <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Lembrar de mim') }}
                        </label>
                    </div>
                </div> --}}
            </div>

            <div class="row mb-0 btn-login">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Esqueceu sua senha?') }}
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</section>

<style>
.btn-login a, .btn-login a:hover{
    text-decoration: none;
    color: #fff;
}

</style>



@endsection


