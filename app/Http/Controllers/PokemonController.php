<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class PokemonController extends Controller{

    public function index(){
        $limit = 8;
        $page = request()->input('page', 1);
    
        // Si no se proporciona un nombre, obtén la lista de Pokémon para mostrar
        $response = Http::get("https://pokeapi.co/api/v2/pokemon?limit=100", [
            'limit' => $limit,
            'offset' => ($page - 1) * $limit,
        ]);
    
        if ($response->successful()) {
            $data = $response->json();
            $list = $data['results'];
    
            foreach ($list as &$pokemon) {
                $pokemonDetails = Http::get($pokemon['url'])->json();
                $pokemon['image'] = $pokemonDetails['sprites']['other']['official-artwork']['front_default'];
                $pokemon['id'] = $pokemonDetails['id'];
    
                $types = [];
                foreach ($pokemonDetails['types'] as $typeData) {
                    $typeDetailsResponse = Http::get($typeData['type']['url']);
                    if ($typeDetailsResponse->successful()) {
                        $typeDetails = $typeDetailsResponse->json();
                        $typeNames = $typeDetails['names'];
                    }
                    foreach ($typeNames as $typeName) {
                        if ($typeName['language']['name'] === 'es') {
                            $types[] = $typeName['name'];
                            break;
                        }
                    }
                }
                $pokemon['types'] = $types;
            }
    
            // Crear una colección paginada a partir de la lista de Pokémon
            $perPage = $limit;
            $currentPage = LengthAwarePaginator::resolveCurrentPage('page') ?: 1;
            $items = array_slice($list, ($currentPage - 1) * $perPage, $perPage);
    
            $pagination = new LengthAwarePaginator(
                $items,
                count($list),
                $perPage,
                $currentPage
            );
    
            return view('pokemons.index', compact('list', 'page', 'pagination'));
        } else {
            return response()->json(['error' => 'No se pudo obtener información de Pokémon.'], $response->status());
        }
    }



    // --------------------------
    
    public function show(string $id){

            $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$id}");
            
        if ($response->successful()) {
            $pokemon = $response->json();

            $pokemon['name']= strtoupper(substr($pokemon['name'], 0, 1)) . substr($pokemon['name'], 1);

            // dd($pokemon);
           $speciesResponse = Http::get($pokemon['species']['url']);
            // obtener siguente pokemon
            $prevPokemon = $this->getAdjacentPokemon($id, 'prev');
            $nextPokemon = $this->getAdjacentPokemon($id, 'next');


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
        // dd($details);
    }
            return view('pokemons.detalles', compact('pokemon', 'description', 'types', 'debilidades', 'nextPokemon', 'prevPokemon'));
        }else{
            return response()->json(['error'=>'No se pudo obtener información del Pokémon'], $response->status());
        }
    }


    // ----------obtener pokemon buscandolo por el input--------------------------------


    

    // ----------obtener pokemon para navegacion-------------------------

    private function getAdjacentPokemon($currentId, $direction = 'next'){
        $offset = ($direction == 'next') ? 1 : -1;
        $adjacentId = $currentId + $offset;

        // Obtén la información del Pokémon siguiente o anterior
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$adjacentId}");

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }


}
