<table class="table">
    <thead>
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Equipo Local</th>
            <th class="text-center">Equipo Visitante</th>
            <th class="text-center">Resultado Local</th>
            <th class="text-center">Resultado Visitante</th>
            <th class="text-center">Fecha</th> <!-- Agregamos la columna Fecha -->
            <th class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($fixtures as $fixture)
            <tr>
                <td class="text-center">{{ $fixture->id }}</td>
                <td class="text-center">{{ $fixture->equipoLocal->nombre }}</td>
                <td class="text-center">{{ $fixture->equipoVisitante->nombre }}</td>
                <td class="text-center">{{ $fixture->resultado_local }}</td>
                <td class="text-center">{{ $fixture->resultado_visitante }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($fixture->fecha)->format('d/m/Y') }}</td>
                <!-- Mostramos la fecha formateada -->
                <td class="text-center">
                    <a href="{{ route('fixture.edit', $fixture->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('fixture.destroy', $fixture->id) }}" method="POST"
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
