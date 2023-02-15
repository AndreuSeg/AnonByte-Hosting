@extends('generals.head')
@section('tittle', 'Contact form')

@section('main')
    <div class="log-in mt-40 w-full">
        <h1 class="text-4xl">Contacta con nosotros</h1>
        <form class="log-in-form gap-3 p-4" method="POST" action="">
            @csrf
            <div class="textbox">
                <label class="mt-2 ml-2" for="email">Email</label>
                <input class="pt-2 pb-2 pl-4 pr-4 rounded" type="email" name="email" placeholder="Email" required>
            </div>
            <div class="textbox">
                <label class="mt-2 ml-2" for="message">Mensaje</label>
                <input class="pt-2 pb-2 pl-4 pr-4 rounded" type="message" name="message" placeholder="Introduce tu mensaje" required>
            </div>
            <button class="log-in-button text-white p-3 rounded relative bottom-4 mt-6" type="submit">Enviar</button>
        </form>
    </div>
@endsection
