@extends('layouts.website')

@section('content')
<div class="auth auth-bg">
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <form method="POST" action="{{ route('login') }}" class="card card-body">
                    @csrf
    
                    <div class="form-group">
                        <h3 class="card-title text-center text-muted text-uppercase font-weight-bold">Iniciar <span class="text-primary">Sesión</span></h3>
                        <p class="card-text font-weight-bold text-muted text-center">
                            ¿Aún no tienes una cuenta?
                            <a href="{{ route('register') }}" class="text-primary text-decoration-none">Registrate</a>
                        </p>
                    </div>
    
                    <div class="form-group mt-3">
                        <label class="font-weight-bold text-muted" for="email">CORREO ELECTRONICO</label>
                        <input type="email" id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="ej, demo@happydaysfreedom.com" name="email" value="{{ old('email') }}" autocomplete="off" autofocus>
    
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
    
                    <div class="form-group">
                        <label class="font-weight-bold text-muted" for="password">CONTRASEÑA</label>
                        <input type="password" id="password" name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Ingrese la clave" autocomplete="off">
    
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="switch">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="slider round"></span>
                        </label>
                        <span class="text-muted">Recordarme</span>
                    </div>
    
                    <b-button pill variant="outline-primary" type="submit">
                        INGRESAR
                    </b-button>

                    <hr>

                    <b-button pill variant="secondary" href="{{ route('website') }}">
                        REGRESAR
                    </b-button>

                    <br>

                    @if (Route::has('password.request'))
                        <div class="form-group">
                            <p class="card-text font-weight-bold text-muted text-center">
                                <a href="{{ route('password.request') }}" class="text-primary text-decoration-none">¿Olvide Mi Contraseña?</a>
                            </p>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
