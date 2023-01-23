@extends('admin.generals.head')
@section('tittle', 'Login-Admin')

@section('main')
    <div class="log-in-admin mt-40 w-full">
        <h2>Log In Admins</h2>
        <form class="log-in-form gap-3 p-4 w-2/6" method="POST" action="{{ route('login-admin') }}">
            @csrf
            <div class="textbox">
                <label class="mt-2 ml-2" for="email">Email</label>
                <input class="pt-2 pb-2 pl-4 pr-4 rounded @error('credentials') is-invalid @enderror" type="email" name="email" required>
            </div>
            <div class="textbox">
                <label class="mt-2 ml-2" for="password">Password</label>
                <input class="pt-2 pb-2 pl-4 pr-4 rounded" type="password" name="password" required>
            </div>
            @error('credentials')
                <p class="bg-slate-500">{{ $message }}</p>
            @enderror
            <button class="log-in-button p-3 rounded" type="submit">Iniciar sesión</button>
        </form>
    </div>
@endsection
