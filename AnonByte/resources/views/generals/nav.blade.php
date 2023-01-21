<nav class="home_nav w-full bg-white">
    <a href="">
        <div class="logo">
            <img class="w-20 ml-2 mr-2" src="{{ asset('images/logo.png') }}" alt="logo">
            <h1>AnonByte</h1>
        </div>
    </a>
    <ul class="menu-horizontal mr-6 gap-5">
        <a class="text-black no-underline" href="{{ route('home') }}"><li>Home</li></a>
        <a class="text-black no-underline" href="{{ route('contact') }}"><li>Contacto</li></a>
        <a class="text-black no-underline" href="{{ route('form-login') }}"><li>Iniciar sesion</li></a>
        <a class="text-black no-underline" href="{{ route('form-signup') }}"><li>Registrase</li></a>
    </ul>
</nav>
