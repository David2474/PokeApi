<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokemonController extends Controller{

    
    public function index(){

        $limit = 8;
        $page = request()->input('page', 1);
        
        $response = Http::get('https://pokeapi.co/api/v2/pokemon', [
            'limit' => $limit,
            'offset' => ($page - 1) * $limit,
        ]);
        
        if($response->successful()){
            $data = $response->json();

            $list = $data['results'];


            foreach($list as &$pokemon){
                $details = Http::get($pokemon['url'])->json();
                $pokemon['image'] = $details['sprites']['other']['official-artwork']['front_default'];
                $pokemon['id'] = $details['id'];



                $types = [];

                foreach($details['types'] as $typeData){

                    $typeResponse = Http::get($typeData['type']['url']);
                    if($typeResponse->successful()){
                        $dataResponse = $typeResponse->json();
                        $typeName = $dataResponse['names'];
                        
                    }
                    foreach($typeName as $typeNames){
                        if($typeNames['language']['name'] === 'es'){
                            $types = $typeNames['name'];
                            break;
                        }
                    }
                }
                $pokemon['types'] = $types;
                // dd($pokemon);
            }

            return view('pokemons.index', compact('list', 'page'));
        }
        
    }         
    

}
