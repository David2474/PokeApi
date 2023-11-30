<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokemonController extends Controller{
    
    public function index()
    {
        $response = Http::get('https://pokeapi.co/api/v2/pokemon?limit=100000&offset=0');
        $pokemonData = $response->json();

        // dd($pokemonData);
        return view('pokemons.index', ['pokemonData' => $pokemonData]);
    }
}
