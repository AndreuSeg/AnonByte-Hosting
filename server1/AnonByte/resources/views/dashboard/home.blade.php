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
                <a href="">
                    <i class="bi bi-folder"></i>
                    <h3>File Manager</h3>
                </a>
                <a href="">
                    <i class="bi bi-app-indicator"></i>
                    <h3>Web Page</h3>
                </a>
                <form class="ml-8 gap-3" action="{{ route('logout') }}" method="post">
                    @csrf
                    <i class="bi bi-box-arrow-right"></i>
                    <button>Log Out<br><span class="text-blue-500">{{ $username }}</span></button>
                </form>
            </div>
        </aside>
        <main>
            <h1 class="text-3xl font-extrabold">Dashboard</h1>
            <div class="dashboard gap-4 mt-20 ml-20">
                <div class="stats">
                    {!! $stats !!}
                </div>
                <script>
                    setInterval(function() {
                        $.get('{{ route('dashboard.stats') }}', function(data) {
                            $('.stats').html(data);
                        });
                    }, 1000); // Envía la petición cada 3 segundos
                </script>
                <div class="other_staff gap-4">
                    <div class="cont files">
                    </div>
                    <div class="cont web">
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
