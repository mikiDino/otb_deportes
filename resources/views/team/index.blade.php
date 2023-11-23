@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="javascript:void(0)" class="btn btn-primary agregar" data-bs-toggle="modal"
            data-bs-target="#crearTeamModal">Crear Nueva
            Equipo</a>

        <form method="get" class="d-flex justify-content-center gap-2 " id="equiposForm">
            <h2 class="title">Categoria</h2>
            <div class="col-md-12">
                <select name="categoria" id="categoria" class="form-select" onchange="submitForm()">
                    <option value="" selected></option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @if ($loop->first) selected @endif>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
        <div class="table-container" id="table-container">
           @include('team.partials.team_table')
        </div>
    </div>

    <!-- Modal para crear equipo -->
    <div class="modal fade" id="crearTeamModal" tabindex="-1" aria-labelledby="crearTeamModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearTeamModalLabel">Crear Equipo</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('team.partials.create')
                </div>
            </div>
        </div>
    </div>

    <!-- Modales de edición y eliminación -->
    @foreach ($teams as $team)
        <!-- Modal para editar equipo -->
        <div class="modal fade" id="editarTeamModal{{ $team->id }}" tabindex="-1"
            aria-labelledby="editarTeamModalLabel{{ $team->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarTeamModalLabel{{ $team->id }}">Editar Equipo</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('team.partials.edit')
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para eliminar equipo -->
        <div class="modal fade" id="eliminarTeamModal{{ $team->id }}" tabindex="-1"
            aria-labelledby="eliminarTeamModalLabel{{ $team->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eliminarTeamModalLabel{{ $team->id }}">Eliminar Equipo</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estás seguro de que deseas eliminar el equipo "{{ $team->nombre }}"?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form action="{{ route('equipos.destroy', $team->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        // Agregar un controlador de clic para mostrar/ocultar detalles
        $(document).ready(function() {

            var categoriaSelect = document.getElementById("categoria");

            categoriaSelect.addEventListener("change", function() {
                var categoriaSeleccionada = categoriaSelect.value;

                fetch("{{ route('equipos.filter') }}?categoria=" + categoriaSeleccionada)
                    .then(response => response.text())
                    .then(data => {
                        // Actualizar el contenido de la tabla con los nuevos equipos
                        var tableContainer = document.getElementById('table-container');
                        tableContainer.innerHTML = data;
                    })
                    .catch(error => console.error('Error:', error));
            });


            $('.toggle-details').click(function() {
                var teamId = $(this).data('team-id');
                var detailsRow = $('.details-row[data-team-id="' + teamId + '"]');
                detailsRow.toggle(); // Muestra u oculta la fila de detalles
            });
        });
    </script>
@endsection
