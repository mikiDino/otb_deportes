<form method="POST" action="{{ route('equipos.store') }}">
    @csrf

    <div class="form-group">
        <label for="nombre_equipo">Nombre del Equipo</label>
        <input id="nombre_equipo" type="text" class="form-control @error('nombre_equipo') is-invalid @enderror"
            name="nombre_equipo" value="{{ old('nombre_equipo') }}" required autofocus>
        @error('nombre_equipo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="nombre_barrio">Nombre del Barrio</label>
        <input id="nombre_barrio" type="text" class="form-control @error('nombre_barrio') is-invalid @enderror"
            name="nombre_barrio" value="{{ old('nombre_barrio') }}" required autofocus>
        @error('nombre_barrio')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="nombre_dt">Nombre del DT</label>
        <input id="nombre_dt" type="text" class="form-control @error('nombre_dt') is-invalid @enderror"
            name="nombre_dt" value="{{ old('nombre_dt') }}" required>
        @error('nombre_dt')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="celular_dt">Celular del DT</label>
        <input id="celular_dt" type="text" class="form-control @error('celular_dt') is-invalid @enderror"
            name="celular_dt" value="{{ old('celular_dt') }}" required>
        @error('celular_dt')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <hr>
    <div class="form-group">
        <label for="categoria_id">Categoría</label>
        <select id="categoria_id" class="form-control" name="categoria_id" required>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
            @endforeach
        </select>
    </div>
    <hr>
    <div class="form-group gap-y-2">
        <label for="jugadores">Jugadores</label>
        <div id="jugadores">
            <div class="form-row mb-2">
                <div class="col">
                    <input type="text" class="form-control" name="jugadores[nombre][]"
                        placeholder="Nombre del Jugador">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="jugadores[apellidos][]"
                        placeholder="Apellidos del Jugador">
                </div>
                <div class="col">
                    <input type="number" class="form-control" name="jugadores[edad][]" placeholder="Edad del Jugador">
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-success btn-add">Agregar Jugador</button>
    </div>

    <div class="container-lista-jugadores">
        <h4>Lista de Jugadores</h4>
        <div class="scroll-container">
            <ul id="lista-jugadores" class="list-group"></ul>
        </div>
    </div>

    <div class="form-group mx-auto col-4 text-center">
        <button type="submit" class="btn btn-primary">
            {{ __('Crear Equipo') }}
        </button>
    </div>
    {{-- form oculto que contiene los datos de los jugadores --}}
    <input type="hidden" name="jugadores_data" id="jugadores_data" value="">
</form>
<script>
    $(document).ready(function() {
        // Agregar jugador
        function agregarJugador() {
            var nombre = $('input[name="jugadores[nombre][]"]').val();
            var apellidos = $('input[name="jugadores[apellidos][]"]').val();
            var edad = $('input[name="jugadores[edad][]"]').val();

            if (nombre && apellidos && edad) {
                var jugadorHTML = '<li class="list-group-item">' + nombre + ' ' + apellidos + ' (' + edad +
                    ' años) <i class="fas fa-times-circle btn btn-outline-danger rounded-circle btn-remove"></i></li>';
                $('#lista-jugadores').append(jugadorHTML);

                // Limpiar los campos de entrada
                $('input[name="jugadores[nombre][]"]').val('');
                $('input[name="jugadores[apellidos][]"]').val('');
                $('input[name="jugadores[edad][]"]').val('');
            }
        }

        // Evento al hacer clic en "Agregar Jugador"
        $('.btn-add').click(function() {
            agregarJugador();
        });

        // Eliminar jugador
        $('#lista-jugadores').on('click', 'li i.btn-remove', function() {
            $(this).parent('li').remove();
        });

        $('form').submit(function() {
            var jugadores = [];

            // Recopila los datos de los jugadores en un arreglo
            $('#lista-jugadores li').each(function() {
                var jugadorInfo = $(this).text().trim();
                jugadores.push(jugadorInfo);
            });

            // Convierte el arreglo en JSON y guárdalo en el campo oculto
            $('#jugadores_data').val(JSON.stringify(jugadores));
        });
    });
</script>
