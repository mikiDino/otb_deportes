<form action="{{ route('categorias.store') }}" method="POST">
    @csrf

    <input type="hidden" id="categoria_id" name="categoria_id" value="">
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
