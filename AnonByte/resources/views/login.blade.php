@extends('generals.head')
@section('tittle', 'Login')

@section('main')
    <div class="log-in mt-40 w-full">
        <h2>Log In</h2>
        <form class="log-in-form gap-3 p-4 w-2/6" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="textbox">
                <label class="mt-2 ml-2" for="email">Email</label>
                <input class="pt-2 pb-2 pl-4 pr-4 rounded @error('credentials') is-invalid @enderror" type="email" name="email" required>
            </div>
            <div class="textbox">
                <label class="mt-2 ml-2" for="password">Password</label>
                <input class="pt-2 pb-2 pl-4 pr-4 rounded" type="password" name="password" required>
            </div>
            <div class="flex flex-row">
                <input class="mt-2 ml-2" type="checkbox" name="remember"/>
                <label class="ml-2 pt-2" for="remember">Remeber me</label>
            </div>
            @error('credentials')
                <p class="bg-slate-500">{{ $message }}</p>
            @enderror
            <button class="log-in-button text-white p-3 rounded" type="submit">Iniciar sesión</button>
        </form>
        <p class="text-center">¿Todavia no tienes cuenta?<a class="no-unerline" href="{{ route('form-signup') }}"><br><b>Registrate</b></a></p>
    </div>
@endsection
