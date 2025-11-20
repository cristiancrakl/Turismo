@extends('layouts.app_authenticator')

@section('title', 'Login')

@section('content')

<div class="login-box">
    <div class="card">
        <div class="card-header text-center">
            <div class="user-icon">
                <i class="fas fa-leaf"></i>
            </div>
            <h1 class="h1">TripLocal</h1>
            <p class="login-box-msg">Inicia sesión en tu cuenta</p>
        </div>
        <div class="card-body">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                        placeholder="Email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password" placeholder="Contraseña">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="icheck-primary">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Iniciar Sesión →</button>
            </form>

            <div class="social-auth-links">
                <p>O continúa con</p>
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

            <p class="mb-1">
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                @endif
            </p>
            <div class="register-link">
                <p>¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
            </div>
        </div>
    </div>
</div>
@endsection