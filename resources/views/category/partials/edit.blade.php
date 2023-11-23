<form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" class="form-control" value="{{ $categoria->nombre }}">
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>
