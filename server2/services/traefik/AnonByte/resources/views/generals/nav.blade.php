<nav class="home_nav w-full bg-white">
    <a href="{{ route('home') }}">
        <div class="logo">
            <img class="w-16 ml-2" src="{{ asset('images/logo.png') }}" alt="logo">
            <h1 class="font-semibold text-xl">AnonByte</h1>
        </div>
    </a>
    <ul class="menu-horizontal mr-4 gap-6">
        <li class="text-center text-base"><a href="{{ route('home') }}">Home</a></li>
        <li class="text-center text-base"><a href="{{ route('contact') }}">Contacto</a></li>
        <li class="text-center text-base"><a href="{{ route('form-login') }}">Iniciar Sesión</a></li>
        <li class="text-center text-base"><a href="{{ route('form-signup') }}">Registrase</a></li>
    </ul>
</nav>
