<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokemonController extends Controller{

    
    public function index(){
        
        $response = Http::get('https://pokeapi.co/api/v2/pokemon');
        $pokemonData = $response->json()['results'];
        
        foreach($pokemonData as &$pokemones){
            $getData = Http::get($pokemones['url'])->json();
            $pokemones['image_url'] = $getData['sprites']['front_default'];
            $pokemones['id'] = $getData['id'];
        }
        // dd($pokemonData);
        return view('pokemons.index', compact('pokemonData'));

    }         
    
}
