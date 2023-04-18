@extends('dashboard.generals.head')
@section('tittle', 'Dashboard')

@section('main')
    <div class="padre mt-0 mb-0 ml-8 mr-8 gap-7">
        <aside class="bg-slate-200">
            <div class="top bg-white mt-6">
                <div class="logo gap-2 pt-2 pb-2">
                    <img class="w-16 h-16" src="{{ asset('images/logo.png') }}" alt="logo">
                    <h2 class="font-extrabold text-2xl">Anon<span class="blue text-blue-500">Byte</span></h2>
                </div>
                <div class="close">
                    <i class="bi bi-x-lg"></i>
                </div>
            </div>
            <div class="sidebar">
                <a class="active" href="">
                    <i class="bi bi-box-fill"></i>
                    <h3>Dashboard</h3>
                </a>
                </a>
                <a href="">
                    <i class="bi bi-clipboard2-data-fill"></i>
                    <h3>Logs</h3>
                </a>
                <form class="ml-8 gap-3" action="{{ route('auth.logout') }}" method="post">
                    @csrf
                    <i class="bi bi-box-arrow-right"></i>
                    <button>Log Out<br><span class="text-blue-500">{{ $username }}</span></button>
                </form>
            </div>
        </aside>
        <main>
            <h1 class="text-3xl font-extrabold pt-8 pl-8">Dashboard</h1>
            <div class="dashboard gap-4 mt-20 ml-20">
                <div class="stats">
                    {!! $stats !!}
                </div>
            </div>
        </main>
    </div>
@endsection
