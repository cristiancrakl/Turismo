@extends('layouts.app_authenticator')

@section('title', 'Register')

@section('content')

<div class="login-box">
    <div class="card">
        <div class="card-header text-center">
            <div class="user-icon">
                <i class="fas fa-leaf"></i>
            </div>
            <h1 class="h1">TripLocal</h1>
            <p class="login-box-msg">Crea una cuenta para explorar</p>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="input-group">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nombre">

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password" placeholder="Contraseña">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password" placeholder="Confirmar Contraseña">
                </div>

                <button type="submit" class="btn btn-primary">Crear Cuenta →</button>
            </form>

            <div class="social-auth-links">
                <p>O regístrate con</p>
                <div class="social-buttons">
                    <a href="#" class="btn btn-info" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="btn btn-danger" title="Google">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#" class="btn btn-dark" title="Apple">
                        <i class="fab fa-apple"></i>
                    </a>
                </div>
            </div>

            <div class="register-link">
                <p>¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia Sesión</a></p>
            </div>
        </div>
    </div>
</div>
@endsection