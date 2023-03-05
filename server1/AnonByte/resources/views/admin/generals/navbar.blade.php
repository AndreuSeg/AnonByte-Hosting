@section('nav')
    <nav>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
        <div class="filtros gap-4">
            <form action="">
                @csrf
                <input class="rounded p-2 w-full bg-slate-300" type="text" name="users"
                    placeholder="Filtrar por nombre o email">
            </form>
            <a href="{{ route('admin.users.users-table') }}">
                <button class="borrar-filtros-button bg-slate-400 p-2 rounded text-white" type="submit">&#10007; Borrar
                    filtros</button>
            </a>
        </div>
    </nav>
@endsection
