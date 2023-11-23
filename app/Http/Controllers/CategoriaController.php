<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    { 
        $categorias = Categoria::all();
        return view('category.index', compact('categorias'));
    }

    public function create()
    {
        return view('category.partials.create');
    }

    public function store(Request $request)
    {
        try {
            Categoria::create($request->all());
            return redirect()->route('categorias.index')->with('success', 'Categoría creada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('categorias.index')->with('error', 'Error al crear la categoría: ' . $e->getMessage());
        }
    }

    public function show(Categoria $categoria)
    {
        return view('category.partials.show', compact('categoria'));
    }

    public function edit(Categoria $categoria)
    {
        return view('category.partials.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        try {
            $categoria->update($request->all());
            return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('categorias.index')->with('error', 'Error al actualizar la categoría: ' . $e->getMessage());
        }
    }

    public function destroy(Categoria $categoria)
    {
        try {
            $categoria->delete();
            return redirect()->route('categorias.index')->with('success', 'Categoría eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('categorias.index')->with('error', 'Error al eliminar la categoría: ' . $e->getMessage());
        }
    }
}
