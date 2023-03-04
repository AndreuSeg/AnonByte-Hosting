@extends('dashboard.generals.head')
@section('tittle', 'Dashboard')

@section('main')
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
            }, 3000); // Envía la petición cada 3 segundos
        </script>

        <div class="other_staff gap-4">
            <div class="cont files">
            </div>
            <div class="cont web">
            </div>
        </div>
    </div>
@endsection
