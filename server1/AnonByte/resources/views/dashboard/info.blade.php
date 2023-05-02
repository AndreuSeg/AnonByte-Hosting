@extends('dashboard.generals.head')
@section('tittle', 'Info Dashboard')

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
                <a href="{{ route('dashboard-dashboard') }}">
                    <i class="bi bi-bar-chart-fill"></i>
                    <h3>Dashboard</h3>
                </a>
                </a>
                <a class="active">
                    <i class="bi bi-info-circle-fill"></i>
                    <h3>Info</h3>
                </a>
                <form class="ml-8 gap-3" action="{{ route('auth.logout') }}" method="post">
                    @csrf
                    <i class="bi bi-box-arrow-right"></i>
                    <button>Log out <span class="text-blue-500">{{ $username }}</span></button>
                </form>
            </div>
        </aside>
        <main>
            <h1 class="text-3xl font-extrabold pt-8 pl-8">Dashboard</h1>
            <div class="dashboard gap-4 mt-20 ml-20">
                <div class="info bg-slate-500 p-1">
                    <h1 class="text-center font-bold text-4xl bg-slate-500">Información</h1>
                    <div class="info2 pl-4 pr-4 pt-2 pb-2 bg-slate-50">
                        <p class="important">Antes que nada decirte que para que todo funcione al 100% deberas esperar un par de minutos hasta que todos los contenedores esten creados. Maximo 5 minutos.</p>
                        <br>
                        <p>Nombre de la App: <b>{{ $appname }}</b></p>
                        <br>
                        <ul>
                            <h2 class="text-2xl">Enlaces:</h2>
                            <li>Sitio Web: <a class="underline text-blue-600" href="http://{{ $domain }}">{{ $domain }}</a></li>
                            <li>PhpMyAdmin: <a class="underline text-blue-600" href="http://{{ $phpmyadmin }}">{{ $phpmyadmin }}</a></li>
                        </ul>
                        <br>
                        <ul>
                            <h2 class="text-2xl">Base de datos:</h2>
                            <p class="important">Por razones de seguridad no mostramos las credenciales en esta pagina.</p>
                            <li>Nombre del servidor: <b>db{{ $appname }}</b></li>
                            <li>Base de datos: <b>{{ $db }}</b></li>
                            <li>Usuario: <b>{{ $dbuser }}</b></li>
                        </ul>
                        <br>
                        <h2 class="text-2xl">Ejemplo:</h2>
                        <p>Si el nombre de la App es: <b>Byte</b>. El usuario es: <b>paco</b>. Y la contraseña es: <b>123456789</b></p>
                        <p>Deberas rellenar los campos de esta manera.</p>
                        <img src="{{ asset('images/ex.png') }}" alt="Ejemplo">
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
