@extends('layouts.app')

@section('content')
    <div class="container">
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#crearFixtureModal">
            Crear Nuevo Fixture
        </button>
        <form id="filterForm">
            @csrf
            <div class="d-flex justify-content-center gap-2">
                <h2 class="title">Filstro por Fecha</h2>
                <select class="form-select" id="fecha" name="fecha">
                    <option value="">Seleccionar fecha</option>
                    @php
                        $defaultDate = $dates->first(); // Establecer la primera fecha como predeterminada
                    @endphp
                    @foreach ($dates as $date)
                        <option value="{{ $date }}" @if ($date == $defaultDate) selected @endif>
                            {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
        <div class="table-container" id="fixtureTable">
            @include('fixture.partials.fixture_table', ['fixtures' => $fixtures])
        </div>
    </div>

    <div class="modal fade" id="crearFixtureModal" tabindex="-1" aria-labelledby="crearFixtureModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearFixtureModalLabel">Crear Nuevo Fixture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('fixture.partials.create')
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        @include('layouts.alert', ['message' => session('success'), 'type' => 'success'])
    @endif

    @if (session('error'))
        @include('layouts.alert', ['message' => session('error'), 'type' => 'error'])
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fechaSelect = document.getElementById('fecha');
            const filterForm = document.getElementById('filterForm');
            const fixtureTable = document.getElementById('fixtureTable');

            fechaSelect.addEventListener('change', function () {
                const formData = new FormData(filterForm);

                fetch("{{ route('fixture.filter') }}", {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    fixtureTable.innerHTML = data; // Actualizar la tabla con los fixtures filtrados
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>
@endsection
