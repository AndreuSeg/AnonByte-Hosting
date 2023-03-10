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
                <th class="bg-slate-500 p-2 text-left font-bold">Id</th>
                <th class="bg-slate-500 p-2 text-left font-bold">Name</th>
                <th class="bg-slate-500 p-2 text-left font-bold">Lastname</th>
                <th class="bg-slate-500 p-2 text-left font-bold">Username</th>
                <th class="bg-slate-500 p-2 text-left font-bold">Email</th>
                <th class="bg-slate-500 p-2 text-left font-bold">Role Name</th>
                <th class="bg-slate-500 p-2 text-left font-bold">Stack Created</th>
                <th class="bg-slate-500 p-2 text-left font-bold">Email Verified</th>
                <th class="bg-slate-500 p-2 text-left font-bold">Created At</th>
                <th class="bg-slate-500 p-2 text-left font-bold"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $u)
                @if ($u['stack_created'] == 1)
                    @php
                        $stackCreated = 'Yes';
                    @endphp
                @else
                    @php
                        $stackCreated = 'No';
                    @endphp
                @endif
                @if ($u['role_id'] == 1)
                    @php
                        $roleName = 'User';
                    @endphp
                @elseif ($u['role_id'] == 2)
                    @php
                        $roleName = 'Administrator';
                    @endphp
                @elseif ($u['role_id'] == 3)
                    @php
                        $roleName = 'Superadministrator';
                    @endphp
                @endif
                <tr>
                    <td class="bg-slate-200 p-2 text-left">{{ $u['id'] }}</td>
                    <td class="bg-slate-200 p-2 text-left">{{ $u['name'] }}</td>
                    <td class="bg-slate-200 p-2 text-left">{{ $u['lastname'] }}</td>
                    <td class="bg-slate-200 p-2 text-left">{{ $u['username'] }}</td>
                    <td class="bg-slate-200 p-2 text-left">{{ $u['email'] }}</td>
                    <td class="bg-slate-200 p-2 text-left">{{ $roleName }}</td>
                    <td class="bg-slate-200 p-2 text-left">{{ $stackCreated }}</td>
                    <td class="bg-slate-200 p-2 text-left">{{ $u['created_at'] }}</td>
                    <td class="bg-slate-200 p-2 text-left">{{ $u['email_verified_at'] }}</td>
                    <td class="bg-slate-200 p-2 text-left">
                        <form method="GET" action="{{ route('admin.users.edit-user', ['id' => $u['id']]) }}">
                            @csrf
                            <button class="btn btn-success w-full mb-1"><i class="bi bi-pencil-fill"></i> Edit</button>
                        </form>
                        <form method="POST" action="{{ route('admin.users.delete-user', ['id' => $u['id']]) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger w-full mt-1 flex"><i class="bi bi-trash3-fill"></i>
                                Delete</button>
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
