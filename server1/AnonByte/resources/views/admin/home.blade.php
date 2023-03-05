@extends('admin.generals.head')
@section('tittle', 'Admin')

@section('main')
@section('nav')
    @include('admin.generals.navbar')
@endsection
<div class="tabla mt-4">
    @if (session()->has('alert'))
        <div class="alert alert-success w-full">
            <i class="bi bi-check-circle-fill"></i> {{ session()->get('alert')['message'] }}
        </div>
    @endif
    <table
        class="users-table w-full border-solid border-slate-500 border-2 table-auto mt-2 border-spacing-5 border-collapse shadow-slate-600 shadow-2xl">
        <thead>
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
