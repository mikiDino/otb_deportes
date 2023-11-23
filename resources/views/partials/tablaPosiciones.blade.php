<div class="container mt-4">
    <h1 class="title">Tabla de Posiciones Categoria Varones</h1>
    <table class="table table-striped">

    </table>
</div>
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Equipo</th>
                <th>Jugados</th>
                <th>Ganados</th>
                <th>Empatados</th>
                <th>Perdidos</th>
                <th>Goles a Favor</th>
                <th>Goles en Contra</th>
                <th>Puntos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posiciones as $posicion)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $posicion->equipo->nombre }}</td>
                    <td>{{ $posicion->juegos_jugados }}</td>
                    <td>{{ $posicion->juegos_ganados }}</td>
                    <td>{{ $posicion->juegos_empatados }}</td>
                    <td>{{ $posicion->juegos_perdidos }}</td>
                    <td>{{ $posicion->goles_a_favor }}</td>
                    <td>{{ $posicion->goles_en_contra }}</td>
                    <td>{{ $posicion->puntos }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
