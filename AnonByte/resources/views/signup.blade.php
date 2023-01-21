@extends('generals.head')
@section('tittle', 'Register')

@section('main')
    <div class="sign-up mt-40 w-full">
        <h2>Sign Up</h2>
        <form class="sign-up-form gap-3 p-4" method="POST" action="{{ route('signup') }}">
            @csrf
            <div class="textbox">
                <label class="mt-2 ml-2" for="username">Username</label>
                <input class="pt-2 pb-2 pl-4 pr-4 rounded" type="text" name="username" required>
            </div>
            <div class="fullname gap-3">
                <div class="textbox">
                    <label class="mt-2 ml-2" for="name">Name</label>
                    <input class="pt-2 pb-2 pl-4 pr-4 rounded" type="text" name="name" required>
                </div>
                <div class="textbox">
                    <label class="mt-2 ml-2" for="lastname">Last Name</label>
                    <input class="pt-2 pb-2 pl-4 pr-4 rounded" type="text" name="lastname" required>
                </div>
            </div>
            <div class="textbox">
                <label class="mt-2 ml-2" for="email">Email</label>
                <input class="pt-2 pb-2 pl-4 pr-4 rounded" type="email" name="email" required>
            </div>
            <div class="textbox">
                <label class="mt-2 ml-2" for="password">Password</label>
                <input class="pt-2 pb-2 pl-4 pr-4 rounded" type="password" name="password" required>
            </div>
            <button class="sign-up-button text-center p-3 rounded" type="submit">Registrarse</button>
        </form>
        <p class="text-center">¿Estas registrado ya?<a class="no-underline" href="{{ route('form-login') }}"><br><b>Accede a tu cuenta</b></a></p>
    </div>
@endsection
