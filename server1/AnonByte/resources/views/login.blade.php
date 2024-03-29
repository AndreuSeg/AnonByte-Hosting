@extends('generals.head')
@section('tittle', 'Login')

@section('main')
    <div class="log-in mt-40 w-full">
        <h1 class="text-4xl">Log In</h1>
        <form class="log-in-form gap-2 pt-4" method="POST" action="{{ route('auth.login') }}">
            @csrf
            <div class="textbox">
                <label class="mt-2 ml-2" for="email">Email</label>
                <input class="pt-1 pb-1 pl-2 rounded @error('email') is-invalid @enderror" type="email" name="email"
                    placeholder="Email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="textbox">
                <label class="mt-2 ml-2" for="password">Password</label>
                <input id="pass2" class="pt-1 pb-1 pl-2 rounded @error('password') is-invalid @enderror"
                    type="password" name="password" placeholder="Contraseña">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                {{-- Butones para mostrar ocultar contraseña --}}
                <span>
                    <svg onclick="password2()" class="eyeclosed2" xmlns="http://www.w3.org/2000/svg" width="20"
                        height="20" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                        <path
                            d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z" />
                        <path
                            d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z" />
                        <path
                            d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z" />
                    </svg>
                </span>
                <span>
                    <svg onclick="password2()" class="eye2" xmlns="http://www.w3.org/2000/svg" width="20"
                        height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                        <path
                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                    </svg>
                </span>
                {{-- Butones para mostrar ocultar contraseña --}}

            </div>
            @if (session()->has('error'))
                <div class="alert alert-danger w-full">
                    <i class="bi bi-exclamation-triangle"></i> {{ session()->get('error')['message'] }}
                </div>
            @endif
            <div class="flex flex-row relative bottom-4">
                <input class="ml-2" type="checkbox" name="remember" />
                <label class="ml-2" for="remember">Remember me</label>
            </div>
            <button class="log-in-button text-white p-3 rounded relative bottom-4" type="submit">Iniciar sesión</button>
        </form>
        <p class="text-center">¿Todavia no tienes cuenta?
            <a class="no-unerline" href="{{ route('auth.form-signup') }}"><br>
                <b>Registrate</b>
            </a>
        </p>
    </div>
@endsection
