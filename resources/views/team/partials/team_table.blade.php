<table class="table">
    <thead>
        <tr>
            <th class="d-table-cell text-center">Nombre Equipo</th>
            <th class="d-table-cell text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($teams as $team)
            <tr>
                <td class="d-table-cell text-center">{{ $team->nombre }}</td>
                <td class="d-table-cell text-center">
                    <!-- Botón para mostrar/ocultar detalles -->
                    <button type="button" class="btn btn-info toggle-details"
                        data-team-id="{{ $team->id }}">Ver Detalles</button>
                    <a href="#" class="btn btn-warning edit-button" data-bs-toggle="modal"
                        data-bs-target="#editarTeamModal{{ $team->id }}" data-team-id="{{ $team->id }}"
                        data-team-nombre="{{ $team->nombre }}">Editar</a>
                    <a href="#" class="btn btn-danger delete-button" data-bs-toggle="modal"
                        data-bs-target="#eliminarTeamModal{{ $team->id }}"
                        data-team-id="{{ $team->id }}">Eliminar</a>
                </td>
                </td>
            </tr>
            <!-- Fila oculta con detalles del equipo y jugadores -->
            <tr class="details-row" data-team-id="{{ $team->id }}" style="display: none;">
                <td colspan="2">
                    <strong>Nombre del DT:</strong> {{ $team->nombre_dt }}<br>
                    <strong>Categoría:</strong> {{ $team->categoria->nombre }}<br>
                    <strong>Jugadores:</strong>
                    <ul>
                        @foreach ($team->jugadores as $jugador)
                            <li>{{ $jugador->nombre }} {{ $jugador->apellidos }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
