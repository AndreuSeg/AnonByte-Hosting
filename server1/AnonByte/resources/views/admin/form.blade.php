@extends('admin.generals.head')
@section('tittle', 'Editar usuarios')

@section('main')
    <div class="padre mt-40 w-full">
        <h2 class="text-4xl">Edit User {{ $user->name }}</h2>
        <form class="user-edit gap-3 p-4 w-2/6" method="POST" action="{{ route('admin.users.save-user', ['id' => $id]) }}">
            @csrf
            <div class="textbox">
                <label class="mt-2 ml-2" for="name">Nombre</label>
                <input class="pt-2 pb-2 pl-4 pr-4 rounded" type="name" name="name" value="{{ $user->name }}">
            </div>
            <div class="textbox">
                <label class="mt-2 ml-2" for="latname">last Name</label>
                <input class="pt-2 pb-2 pl-4 pr-4 rounded" type="name" name="lastname" value="{{ $user->lastname }}">
            </div>
            <div class="textbox">
                <label class="mt-2 ml-2" for="username">Username</label>
                <input class="pt-2 pb-2 pl-4 pr-4 rounded" type="name" name="username" value="{{ $user->username }}">
            </div>
            <div class="textbox">
                <label class="mt-2 ml-2" for="email">Email</label>
                <input class="pt-2 pb-2 pl-4 pr-4 rounded" type="email" name="email" value="{{ $user->email }}">
            </div>
            <button class="save-button text-center text-white p-3 rounded" type="submit">Guardar</button>
        </form>
        <form action="{{ route('admin.users.users-table') }}">
            @csrf
            <button class="volver w-full bg-slate-400 text-white p-3 rounded" type="submit">Volver</button>
        </form>
    </div>
@endsection
