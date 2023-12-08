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
    

    // --------------------------
    
    public function show(string $id){

            $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$id}");
            
        if ($response->successful()) {
            $pokemon = $response->json();

            $pokemon['name']= strtoupper(substr($pokemon['name'], 0, 1)) . substr($pokemon['name'], 1);

            // dd($pokemon);
           // Obtener la descripción de la especie en español
           $speciesResponse = Http::get($pokemon['species']['url']);

           if($speciesResponse->successful()){
            $speciesDetails = $speciesResponse->json();
            $description = 'No hay una descripción disponible en español.';
            foreach($speciesDetails['flavor_text_entries'] as $flavorTextEntry){
                if($flavorTextEntry['language']['name'] == 'es'){
                    $description = $flavorTextEntry['flavor_text'];
                    break;
                }
            }
           }else{
                $description = 'No hay descripcion disponible.';
           }
           $types = [];
           foreach($pokemon['types'] as $typeData){
                $typeDetailsResponse = Http::get($typeData['type']['url']);
                if($typeDetailsResponse->successful()){
                    $typeDetails = $typeDetailsResponse->json();
                    $typeNames = $typeDetails['names'];
                    foreach($typeNames as $typeName){
                        if($typeName['language']['name'] === 'es'){
                            $types[] = $typeName['name'];
                            break;
                        }
                        // dd($typeDetails);
                    }
                    // Obtener debilidades del tipo
            $typeDamageRelations = $typeDetails['damage_relations'];

            foreach ($typeDamageRelations['double_damage_from'] as $weakness) {
                $weaknessDetailsResponse = Http::get($weakness['url']);

                if ($weaknessDetailsResponse->successful()) {
                    $weaknessDetails = $weaknessDetailsResponse->json();
                    $weaknessNames = $weaknessDetails['names'];

                    foreach ($weaknessNames as $weaknessName) {
                        if ($weaknessName['language']['name'] === 'es') {
                            $debilidades[] = $weaknessName['name'];
                            break;
                        }
                    }
                }
            }
        }
    }
            return view('pokemons.detalles', compact('pokemon', 'description', 'types', 'debilidades'));
        }else{
            return response()->json(['error'=>'No se pudo obtener información del Pokémon'], $response->status());
        }
    }
    

}
