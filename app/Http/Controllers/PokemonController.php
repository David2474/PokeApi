<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class PokemonController extends Controller{

    
    public function index(){

        $limit = 8;
        $page = request()->input('page', 1);

        $response = Http::get("https://pokeapi.co/api/v2/pokemon", [
            'limit' => $limit,
            'offset' => ($page - 1) * $limit,
        ]);

     if($response->successful()){
        $data = $response->json();
         $list = $data['results'];

        //  dd($data);

        foreach ($list as &$pokemon) {
            $pokemonDetails = Http::get($pokemon['url'])->json();
            $pokemon['image'] = $pokemonDetails['sprites']['other']['official-artwork']['front_default'];
            $pokemon['id'] = $pokemonDetails['id'];
            // dd($list);

            $types = [];
            foreach ($pokemonDetails['types'] as $typeData) {

                // Obtener el nombre del tipo en español haciendo una solicitud a la API de tipos
                $typeDetailsResponse = Http::get($typeData['type']['url']);
                if($typeDetailsResponse->successful()){
                    $typeDetails = $typeDetailsResponse->json();
                    $typeNames = $typeDetails['names'];
                }
                foreach($typeNames as $typeName){
                    if($typeName['language']['name'] === 'es'){
                        $types[] = $typeName['name'];
                        break;
                    }
                }
            }
            $pokemon['types'] = $types;
            // dd($pokemon);
        }
        
        $perPage = $limit;
        $currentPage = LengthAwarePaginator::resolveCurrentPage('page') ?: 1;
        $items = array_slice($pokemonDetails, ($currentPage - 1) * $perPage, $perPage);

        $pagination = new LengthAwarePaginator(
            $items,
            count($pokemonDetails),
            $perPage,
            $currentPage
        );
        // dd($pagination);
        return view('pokemons.index', compact('list', 'page', 'pagination'));
     }else{

        return response()->json(['error' => 'No se pudo obtener información del Pokémon'], $response->status());
     }
        
    }     
    
    
    public function show(string $id){

       
    }
    

}
