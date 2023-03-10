@section('nav')
    <nav class="navprincipal">
        <form action="{{ route('auth.logout') }}" method="POST">
            @csrf
            <button class="p-2 rounded text-white" type="submit">Cerrar sesión</button>
        </form>
        <div class="filtros gap-4">
            <form action="">
                @csrf
                <input class="rounded p-2 w-full bg-slate-300" type="text" name="users"
                    placeholder="Filtrar por nombre o email">
            </form>
            <a href="{{ route('admin.users.users-table') }}">
                <button class="borrar-filtros-button p-2 rounded text-white" type="submit">&#10007; Borrar
                    filtros</button>
            </a>
        </div>
    </nav>
@endsection
