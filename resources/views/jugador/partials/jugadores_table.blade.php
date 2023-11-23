<table class="table">
    <thead>
        <tr>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Equipo</th>
            <th>Tarjetas</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($jugadores as $jugador)
            <tr>
                <td><img src="{{ $jugador->foto_url }}" alt="Foto del jugador" style="max-width: 50px;"></td>
                <td>{{ $jugador->nombre }}</td>
                <td>{{ $jugador->apellidos }}</td>
                <td>{{ $jugador->equipo->nombre }}</td>
                <td>
                    Amarillas: {{ $jugador->tarjetas->where('color', 'amarilla')->count() }}<br>
                    Rojas: {{ $jugador->tarjetas->where('color', 'roja')->count() }}
                </td>
                <td>
                    <a href="{{ route('jugadores.edit', $jugador->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('jugadores.destroy', $jugador->id) }}" method="POST"
                        style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('¿Estás seguro de eliminar este jugador?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
