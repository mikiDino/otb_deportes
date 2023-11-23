<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\FixtureController;
use Illuminate\Support\Facades\Route;
use App\Models\TablaPosiciones;
use App\Models\Fixture;

Route::get('/', function () {
    $fixtureByDate = [
        '2023-11-05' => Fixture::with('equipoLocal', 'equipoVisitante')
            ->where('fecha', '2023-11-05')->get(),
        '2023-11-12' => Fixture::with('equipoLocal', 'equipoVisitante')
            ->where('fecha', '2023-11-12')->get(),
        // ... Otros datos del fixture por fecha
    ];
    $posiciones = TablaPosiciones::orderBy('puntos', 'desc')->get();
    return view('welcome', compact('posiciones', 'fixtureByDate'));
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return view('partials.logo');
})->middleware(['auth', 'verified'])->name('dashboard');

// CATEGORIA
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('categorias', CategoriaController::class);
});

// EQUIPOS
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/equipos/filter', [EquipoController::class, 'filter'])->name('equipos.filter');
    Route::resource('equipos', EquipoController::class);
});

// JUGADORES
Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('/jugadores/filter', 'JugadorController@filter')->name('jugadores.filter');
    Route::get('/jugadores/filter', [jugadorController::class, 'filter'])->name('jugadores.filter');
    Route::resource('jugadores', JugadorController::class);
});

// FIXTURE
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/fixtures/filter', [FixtureController::class, 'filter'])->name('fixture.filter');
    Route::get('/fixture/por-categoria',[FixtureController::class, 'equiposPorCategoria'])->name('equipos.porCategoria');
    Route::resource('fixture', FixtureController::class);

});

// REPORTES
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('reportes', ReporteController::class);
});
