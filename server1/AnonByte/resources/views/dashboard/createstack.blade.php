@extends('dashboard.generals.head')
@section('tittle', 'Create Stack')

@section('main')
    <div class="container">
        <form class="gap-2 pt-4 w-full" method="POST" action="{{ route('create-stack') }}">
            @csrf
            <div class="app">
                <h3 class="text-4xl text-center">App</h3>
                <div class="textbox">
                    <label class="mt-2 ml-2" for="app_name">Nombre de la App</label>
                    <input class="pt-1 pb-1 pl-2 rounded @error('app_name') is-invalid @enderror" type="text" name="app_name" placeholder="Nombre de la app">

                    @error('app_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="mysql">
                <h3 class="text-4xl text-center">Mysql</h3>
                <div class="textbox">

                    <label class="mt-2 ml-2" for="db_user">Usuario MYSQL</label>
                    <input class="pt-1 pb-1 pl-2 rounded @error('db_user') is-invalid @enderror" type="text" name="db_user" placeholder="Usuario MYSQL">

                    @error('db_user')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <label class="mt-2 ml-2" for="db_pass">Contraseña usuario MYSQL</label>
                    <input class="pt-1 pb-1 pl-2 rounded @error('db_pass') is-invalid @enderror" type="password" name="db_pass" placeholder="Contraseña usuario MYSQL">

                    @error('db_pass')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <label class="mt-2 ml-2" for="db_root_pass">Contraseña root MYSQL</label>
                    <input class="pt-1 pb-1 pl-2 rounded @error('db_root_pass') is-invalid @enderror" type="password" name="db_root_pass" placeholder="Contraseña root MYSQL">

                    @error('db_root_pass')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <button class="stack-button text-white p-3 rounded" type="submit">Crear Stack</button>
        </form>
    </div>
@endsection
