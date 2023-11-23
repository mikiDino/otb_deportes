@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="javascript:void(0)" class="btn btn-primary agregar" data-bs-toggle="modal"
            data-bs-target="#crearCategoriaModal">Crear
            Nueva Categoría</a>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th class="d-table-cell text-center">ID</th>
                        <th class="d-table-cell text-center">Categoría</th>
                        <th class="d-table-cell text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td class="d-table-cell text-center">{{ $categoria->id }}</td>
                            <td class="d-table-cell text-center">{{ $categoria->nombre }}</td>
                            <td class="d-table-cell text-center">
                                <a href="javascript:void(0)" class="btn btn-warning edit-button" data-bs-toggle="modal"
                                    data-bs-target="#editarCategoriaModal{{ $categoria->id }}"
                                    data-categoria-id="{{ $categoria->id }}"
                                    data-categoria-nombre="{{ $categoria->nombre }}">
                                    Editar
                                </a>

                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#eliminarCategoriaModal{{ $categoria->id }}">
                                    Eliminar
                                </button>

                                <div class="modal fade" id="editarCategoriaModal{{ $categoria->id }}" tabindex="-1"
                                    aria-labelledby="editarCategoriaModalLabel{{ $categoria->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editarCategoriaModalLabel{{ $categoria->id }}">
                                                    Editar Categoría</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @include('category.partials.edit')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal de confirmación para eliminar la categoría -->
                                <div class="modal fade" id="eliminarCategoriaModal{{ $categoria->id }}" tabindex="-1"
                                    aria-labelledby="eliminarCategoriaModalLabel{{ $categoria->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="eliminarCategoriaModalLabel{{ $categoria->id }}">
                                                    Eliminar Categoría</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Estás seguro de que deseas eliminar la categoría
                                                    "{{ $categoria->nombre }}"?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <form action="{{ route('categorias.destroy', $categoria->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para crear categoría -->
    <div class="modal fade" id="crearCategoriaModal" tabindex="-1" aria-labelledby="crearCategoriaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearCategoriaModalLabel">Crear Categoría</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('category.partials.create')
                </div>
            </div>
        </div>
    </div>

    <!-- Verificar si hay un mensaje de éxito -->
    @if (session('success'))
        @include('layouts.alert', ['message' => session('success'), 'type' => 'success'])
    @endif

    <!-- Verificar si hay un mensaje de error -->
    @if (session('error'))
        @include('layouts.alert', ['message' => session('error'), 'type' => 'error'])
    @endif
@endsection
