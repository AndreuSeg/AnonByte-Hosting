@extends('admin.generals.head')
@section('tittle', 'Admin')

@section('main')
    <form class="flex flex-col items-center" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>
    <div class="filtros gap-4 mt-4">
        <form action="">
            @csrf
            <input class="rounded p-2 w-60 bg-slate-300" type="text" name="users" placeholder="Filtrar por nombre o email">
        </form>
        <form action="{{ route('admin.users.users-table') }}">
            @csrf
            <button class="borrar-filtros-button bg-slate-400 p-2 rounded text-white" type="submit">Borrar filtros</button>
        </form>
    </div>
    <div class="tabla">
        @if (session('message'))
            <p class="bg-slate-500 p-1 rounded mt-2 text-white">{{ session('message') }}</p>
        @endif
        <table class="users-table border-solid border-slate-500 border-2 table-auto mt-2 border-spacing-5 border-collapse shadow-slate-600 shadow-2xl">
            <thead class="bg-gray-400">
                <tr>
                    <th class="bg-slate-500 p-2 text-left font-bold">Name</th>
                    <th class="bg-slate-500 p-2 text-left font-bold">Lastname</th>
                    <th class="bg-slate-500 p-2 text-left font-bold">Username</th>
                    <th class="bg-slate-500 p-2 text-left font-bold">Email</th>
                    <th class="bg-slate-500 p-2 text-left font-bold">Role id</th>
                    <th class="bg-slate-500 p-2 text-left font-bold">Email verificated</th>
                    <th class="bg-slate-500 p-2 text-left font-bold"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $u)
                    <tr>
                        <td class="bg-slate-200 p-2 text-left">{{ $u['name'] }}</td>
                        <td class="bg-slate-200 p-2 text-left">{{ $u['lastname'] }}</td>
                        <td class="bg-slate-200 p-2 text-left">{{ $u['username'] }}</td>
                        <td class="bg-slate-200 p-2 text-left">{{ $u['email'] }}</td>
                        <td class="bg-slate-200 p-2 text-left">{{ $u['role_id'] }}</td>
                        <td class="bg-slate-200 p-2 text-left">{{ $u['email_verified_at'] }}</td>
                        <td class="bg-slate-200 p-2 text-left">
                            <form method="GET" action="{{ route('admin.users.edit-user', ['id' => $u['id']]) }}">
                                @csrf
                                <button class="btn btn-success w-full mb-1"><i class="bi bi-pencil-fill"></i> Edit</button>
                            </form>
                            <form method="POST" action="{{ route('admin.users.delete-user', ['id' => $u['id']]) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger w-full mt-1"><i class="bi bi-trash3-fill"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $users->onEachSide(3)->links() }}
        </div>
    </div>
@endsection
