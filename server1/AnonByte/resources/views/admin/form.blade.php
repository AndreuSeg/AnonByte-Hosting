@extends('admin.generals.head')
@section('tittle', 'Editar usuarios')

@section('main')
    <div class="padre mt-40 w-full">
        <h2 class="text-4xl">Edit User {{ $user->name }}</h2>
        <form class="user-edit gap-2 p-2 w-2/6" method="POST" action="{{ route('admin.users.save-user', ['id' => $id]) }}">
            @csrf
            @method('PATCH')
            <div class="textbox">
                <label class="mt-2 ml-2" for="name">Nombre</label>
                <input class="pt-1 pb-1 pl-2 rounded @error('name') is-invalid @enderror" type="text" name="name"
                    value="{{ $user->name }}">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="textbox">
                <label class="mt-2 ml-2" for="lastname">last Name</label>
                <input class="pt-1 pb-1 pl-2 rounded @error('lastname') is-invalid @enderror" type="text"
                    name="lastname" value="{{ $user->lastname }}">

                @error('lastname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="textbox">
                <label class="mt-2 ml-2" for="username">Username</label>
                <input class="pt-1 pb-1 pl-2 rounded @error('username') is-invalid @enderror" type="text"
                    name="username" value="{{ $user->username }}">

                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="textbox">
                <label class="mt-2 ml-2" for="email">Email</label>
                <input class="pt-1 pb-1 pl-2 rounded @error('email') is-invalid @enderror" type="text"
                    name="email" value="{{ $user->email }}">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="textbox">
                <label class="mt-2 ml-2" for="role_id">Role Id</label>
                <input class="pt-1 pb-1 pl-2 rounded @error('role_id') is-invalid @enderror" type="num"
                    name="role_id" value="{{ $user->role_id }}">

                @error('role_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="textbox">
                <label class="mt-2 ml-2" for="stack_created">Stack Created</label>
                <input class="pt-1 pb-1 pl-2 rounded @error('stack_created') is-invalid @enderror" type="num" name="stack_created"
                    value="{{ $user->stack_created }}">

                @error('stack_created')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button class="save-button text-center text-white p-3 rounded" type="submit">Guardar</button>
        </form>
        <a class="flex flex-col p-2 pt-0 w-2/6" href="{{ route('admin.users.users-table') }}">
            <button class="volver bg-slate-400 text-white p-3 rounded" type="submit">Volver</button>
        </a>
    </div>
@endsection
