@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="col-md-6">Listado de Jugadores</h1>
        <div class="d-flex justify-content-center gap-2 col-md-12">
            <h2 class="title">Categoria</h2>
            <div class="col-md-6">
                <form method="get" class="row g-3" id="jugadoresForm">
                    <div class="col-md-8 mb-3">
                        <select name="categoria" id="categoria" class="form-select" onchange="submitForm()">
                            <option value="" selected></option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" @if ($categoriaSeleccionada == $categoria->id) selected @endif>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-container" id="table-container">
            @include('jugador.partials.jugadores_table')
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var categoriaSelect = document.getElementById("categoria");

            categoriaSelect.addEventListener("change", function() {
                var categoriaSeleccionada = categoriaSelect.value;

                fetch("{{ route('jugadores.filter') }}?categoria=" + categoriaSeleccionada)
                    .then(response => response.text())
                    .then(data => {
                        // Actualizar el contenido de la tabla con los nuevos jugadores
                        var tableContainer = document.getElementById('table-container');
                        tableContainer.innerHTML = data;
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
@endsection
