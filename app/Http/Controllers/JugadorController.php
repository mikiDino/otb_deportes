<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jugador;
use App\Models\Categoria;
use Illuminate\Support\Facades\View;

class JugadorController extends Controller
{
    public function index(Request $request)
    {
        $categoriaSeleccionada = $request->input('categoria');

        $categorias = Categoria::all();

        if (!$categoriaSeleccionada && $categorias->isNotEmpty()) {
            $categoriaSeleccionada = $categorias->first()->id;
        }

        $jugadores = Jugador::whereHas('equipo.categoria', function ($query) use ($categoriaSeleccionada) {
            $query->where('id', $categoriaSeleccionada);
        })->get();

        return view('jugador.index', compact('jugadores', 'categorias', 'categoriaSeleccionada'));
    }

    public function filter(Request $request)
    {
        $categoriaSeleccionada = $request->input('categoria');

        $jugadores = Jugador::query();

        if ($categoriaSeleccionada) {
            $jugadores->whereHas('equipo.categoria', function ($query) use ($categoriaSeleccionada) {
                $query->where('id', $categoriaSeleccionada);
            });
        }

        $jugadores = $jugadores->get();

        return View::make('jugador.partials.jugadores_table', compact('jugadores'));
    }
}
