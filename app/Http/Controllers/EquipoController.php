<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\Jugador;
use App\Models\Categoria;

class EquipoController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        $categoriaSeleccionada = $categorias->first()->id;

        $teams = Equipo::with('jugadores')
            ->where('categoria_id', $categoriaSeleccionada)
            ->get();

        return view('team.index', compact('teams', 'categorias', 'categoriaSeleccionada'));
    }
    public function create()
    {
        return view('team.partials.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_equipo' => 'required|string|max:255',
            'nombre_barrio' => 'required|string|max:255',
            'nombre_dt' => 'required|string|max:255',
            'celular_dt' => 'required|string|max:255',
            'categoria_id' => 'required|integer',
            // Agrega las validaciones necesarias para los otros campos del equipo
        ]);

        $equipo = new Equipo();
        $equipo->nombre = $validatedData['nombre_equipo'];
        $equipo->ciudad = $validatedData['nombre_barrio'];
        $equipo->nombre_DT = $validatedData['nombre_dt'];
        $equipo->celular_DT = $validatedData['celular_dt'];
        $equipo->categoria_id = $validatedData['categoria_id'];

        $equipo->save();

        $jugadoresData = json_decode($request->input('jugadores_data'));

        $jugadores = [];

        foreach ($jugadoresData as $jugadorInfo) {
            $parts = explode(' ', $jugadorInfo);
            $nombre = $parts[0];
            $apellidos = $parts[1];
            $edad = intval(trim($parts[2], '()'));
            // La edad puede ser extraída de la cadena también

            $jugadores[] = [
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'edad' => $edad, // Asigna la eda aquí
                'equipo_id' => $equipo->id,
            ];
        }

        Jugador::insert($jugadores);

        return redirect()->route('equipos.index')->with('success', 'Equipo creado exitosamente.');
    }

    public function show(Equipo $equipo)
    {
        return view('team.partials.show', compact('equipo'));
    }

    public function edit(Equipo $equipo)
    {
        return view('team.partials.edit', compact('equipo'));
    }

    public function update(Request $request, Equipo $equipo)
    {
        $equipo->update($request->all());
        return redirect()->route('team.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    public function destroy(Equipo $equipo)
    {
        $equipo->jugadores()->delete();

        $equipo->delete();
        return redirect()->route('equipos.index')->with('success', 'Categoría eliminada exitosamente.');
    }
    public function filter(Request $request)
    {
        $categoriaSeleccionada = $request->input('categoria');

        // Obtener los equipos filtrados por la categoría seleccionada
        $teams = Equipo::with('jugadores')
            ->where('categoria_id', $categoriaSeleccionada)
            ->get();

        // Cargar la vista parcial con los equipos filtrados
        return view('team.partials.team_table', compact('teams'));
    }
}
