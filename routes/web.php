<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;


Route::get('/', [PokemonController::class, 'index']);

// Route::get('/pokemons.index', [PokemonController::class, 'index'])->name('index');

Route::get('/detalles/{id}', [PokemonController::class, 'show'])->name('detalles');

// Ruta para la lista completa
Route::get('/pokemons', [PokemonController::class, 'index'])->name('pokemons.index');

// Ruta para la búsqueda
Route::get('/pokemons/search', [PokemonController::class, 'index'])->name('pokemons.search');



// Route::get('/index', [PokemonController::class, 'buscar'])->name('buscar');







