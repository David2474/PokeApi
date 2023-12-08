<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;


Route::get('/', [PokemonController::class, 'index']);

Route::get('/pokemons.index', [PokemonController::class, 'index'])->name('index');

Route::get('/detalles/{id}', [PokemonController::class, 'show'])->name('detalles');


// Route::get('/index', [PokemonController::class, 'buscar'])->name('buscar');
Route::get('/', [PokemonController::class, 'buscar'])->name('buscar');






