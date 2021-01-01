@extends('layouts.website')

@section('content')
<div class="auth auth-bg">
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <form method="POST" action="{{ route('register') }}" class="card card-body" data-aos="fade-up">
                    @csrf
                    <div class="form-group">
                        <h3 class="card-title text-center text-uppercase">Nueva <span class="text-primary">Cuenta</span></h3>
                        <p class="card-text font-weight-bold text-muted text-center">
                            ¿Ya tienes una cuenta?
                            <a href="{{ route('login') }}" class="text-primary text-decoration-none">Iniciar Sesion</a>
                        </p>
                    </div>
                
                    <div class="form-group">
                        <label class="font-weight-bold text-muted" for="first_name">NOMBRE</label>
                        <input type="text" id="first_name" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="ej, Jose Francisco" value="{{ old('first_name') }}" autocomplete="first_name" autofocus>
                
                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label class="font-weight-bold text-muted" for="last_name">APELLIDOS</label>
                        <input type="text" id="last_name" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Ej, Paredes Rosa" value="{{ old('last_name') }}" autocomplete="last_name">
                
                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label class="font-weight-bold text-muted" for="email">CORREO ELECTRONICO</label>
                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="ej, demo@happydaysfreedom.com" name="email" value="{{ old('email') }}" autocomplete="email">
                
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label class="font-weight-bold text-muted" for="password">CONTRASEÑA</label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Ingrese su clave" autocomplete="new-password">
                
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-label-group">
                        <label class="font-weight-bold text-muted" for="password-confirm">CONFIRMAR CONTRASEÑA</label>
                        <input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder="Repetir clave" autocomplete="new-password">
                
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <br>

                    <b-button pill variant="primary" type="submit">
                        CREAR CUENTA
                    </b-button>
                
                    <hr class="my-3">
                
                    <b-button pill variant="outline-secondary" href="{{ route('website') }}">
                        REGRESAR
                    </b-button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
