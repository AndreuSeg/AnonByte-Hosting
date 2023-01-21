@extends('admin.generals.head')
@section('tittle', 'Admin')

@section('main')
    <div class="filtros gap-4">
        <form action="">
            @csrf
            <input class="rounded p-2 w-40 bg-slate-300" type="text" name="name" placeholder="Filtrar por nombre">
        </form>
        <form action="{{ route('admin.users.users-table') }}">
            @csrf
            <button class="borrar-filtros-button bg-slate-400" type="submit">Borrar filtros</button>
        </form>
    </div>
    <div class="tabla">
        <table
            class="users-table border-solid border-slate-500 border-2 table-auto mt-5
    border-spacing-5 border-collapse shadow-slate-600 shadow-2xl w-5/12">
            <thead class="bg-gray-400">
                <tr>
                    <th class="bg-slate-500 p-2 text-left font-bold">Name</th>
                    <th class="bg-slate-500 p-2 text-left font-bold">Lastname</th>
                    <th class="bg-slate-500 p-2 text-left font-bold">Username</th>
                    <th class="bg-slate-500 p-2 text-left font-bold">Email</th>
                    <th class="bg-slate-500 p-2 text-left font-bold">Role_id</th>
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
                        <td class="bg-slate-200 p-2 text-left">
                            <form method="GET" action="{{ route('admin.users.edit-user', ['id' => $u['id']]) }}">
                                @csrf
                                <button class="btn btn-warning w-full mb-1">Editar</button>
                            </form>
                            <form method="POST" action="{{ route('admin.users.delete-user', ['id' => $u['id']]) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger w-full mt-1">Eliminar</button>
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
