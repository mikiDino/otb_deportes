<form action="{{ route('fixture.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="categoria" class="form-label">Categoría:</label>
        <!-- Input para seleccionar la categoría -->
        <select class="form-select" id="categoria" name="categoria_id">
            <!-- Iterar sobre las categorías disponibles -->
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="equipoLocal" class="form-label">Equipo Local:</label>
        <!-- Input para seleccionar el equipo local -->
        <select class="form-select" id="equipoLocal" name="equipo_local_id">
            <!-- Iterar sobre los equipos disponibles -->
            @foreach ($equipos as $equipo)
                <option value="{{ $equipo->id }}">{{ $equipo->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="equipoVisitante" class="form-label">Equipo Visitante:</label>
        <!-- Input para seleccionar el equipo visitante -->
        <select class="form-select" id="equipoVisitante" name="equipo_visitante_id">
            <!-- Iterar sobre los equipos disponibles -->
            @foreach ($equipos as $equipo)
                <option value="{{ $equipo->id }}">{{ $equipo->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="fecha" class="form-label">Fecha:</label>
        <!-- Input para ingresar la fecha del fixture -->
        <input type="date" class="form-control" id="fecha" name="fecha">
    </div>
    <div class="mb-3">
        <label for="resultadoLocal" class="form-label">Resultado Equipo Local:</label>
        <!-- Input para ingresar el resultado del equipo local -->
        <input type="number" class="form-control" id="resultadoLocal" name="resultado_local">
    </div>
    <div class="mb-3">
        <label for="resultadoVisitante" class="form-label">Resultado Equipo Visitante:</label>
        <!-- Input para ingresar el resultado del equipo visitante -->
        <input type="number" class="form-control" id="resultadoVisitante" name="resultado_visitante">
    </div>
    <button type="submit" class="btn btn-primary">Crear Fixture</button>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categoriaSelect = document.getElementById('categoria');
        const equipoLocalSelect = document.getElementById('equipoLocal');
        const equipoVisitanteSelect = document.getElementById('equipoVisitante');

        categoriaSelect.addEventListener('change', function () {
            const categoriaSeleccionada = categoriaSelect.value;

            fetch("{{ route('equipos.porCategoria') }}?categoria_id=" + categoriaSeleccionada)
                .then(response => response.json())
                .then(data => {
                    if (Array.isArray(data)) {
                        equipoLocalSelect.innerHTML = '';
                        data.forEach(equipo => {
                            equipoLocalSelect.innerHTML += `<option value="${equipo.id}">${equipo.nombre}</option>`;
                        });

                        const changeEvent = new Event('change');
                        equipoLocalSelect.dispatchEvent(changeEvent);
                    } else {
                        console.error('Error: La respuesta no es un array');
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        equipoLocalSelect.addEventListener('change', function () {
            const equipoLocalSeleccionado = equipoLocalSelect.value;

            const categoriaSeleccionada = categoriaSelect.value;

            fetch("{{ route('equipos.porCategoria') }}?categoria_id=" + categoriaSeleccionada)
                .then(response => response.json())
                .then(data => {
                    if (Array.isArray(data)) {
                        equipoVisitanteSelect.innerHTML = '';
                        const equiposVisitantes = data.filter(equipo => equipo.id !== parseInt(equipoLocalSeleccionado));
                        equiposVisitantes.forEach(equipo => {
                            equipoVisitanteSelect.innerHTML += `<option value="${equipo.id}">${equipo.nombre}</option>`;
                        });
                    } else {
                        console.error('Error: La respuesta no es un array');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>


