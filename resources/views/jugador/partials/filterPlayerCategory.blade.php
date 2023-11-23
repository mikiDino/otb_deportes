<form method="get" class="row g-3" action="{{ route('jugadores.index') }}" id="jugadoresForm">
    <div class="col-md-8 mb-3">
        <select name="categoria" id="categoria" class="form-select" onchange="submitForm()">
            <option value="" selected>Buscar Categoría</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" >{{ $categoria->nombre }}</option>
            @endforeach
        </select>
    </div>
</form>
