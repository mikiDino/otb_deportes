<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fixture;
use App\Models\Categoria;
use App\Models\Equipo;

class FixtureController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        $equipos = Equipo::all();
        $dates = Fixture::selectRaw('DATE(fecha) as date')
            ->distinct()
            ->pluck('date');

        $fixtures = Fixture::with(['equipoLocal', 'equipoVisitante'])->get();
        return view('fixture.index', compact('fixtures', 'dates', 'categorias', 'equipos'));
    }

    public function create()
    {
        // Lógica para mostrar el formulario de creación
        return view('fixture.create');
    }

    public function store(Request $request)
    {
        // Validaciones y lógica de almacenamiento de datos aquí
        // Ejemplo de validación:
        $validatedData = $request->validate([
            'equipo_local_id' => 'required|integer',
            'equipo_visitante_id' => 'required|integer',
            'fecha' => 'required|date',
        ]);

        // Crear un nuevo fixture con los datos validados
        $fixture = new Fixture();
        $fixture->equipo_local_id = $validatedData['equipo_local_id'];
        $fixture->equipo_visitante_id = $validatedData['equipo_visitante_id'];
        $fixture->fecha = $validatedData['fecha'];
        $fixture->resultado_local = $validatedData['resultado_local'] ?? 0;
        $fixture->resultado_visitante = $validatedData['resultado_visitante'] ?? 0;

        $fixture->save();

        // Redireccionar a la página de lista de fixtures o a donde necesites después de guardar
        return redirect()->route('fixture.index')->with('success', 'Fixture creado exitosamente.');
    }


    public function filter(Request $request)
    {
        $fecha = $request->input('fecha');
        $fixtures = Fixture::where('fecha', $fecha)->get();

        return view('fixture.partials.fixture_table', compact('fixtures'));
    }
    public function equiposPorCategoria(Request $request)
    {
        $categoriaId = $request->input('categoria_id');

        // Lógica para obtener los equipos de una categoría específica
        $equipos = Equipo::where('categoria_id', $categoriaId)->get();

        // Puedes devolver los equipos en formato JSON o construir una vista
        return response()->json($equipos);

    }
}
