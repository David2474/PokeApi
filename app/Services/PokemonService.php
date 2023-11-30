// app/Services/PokemonService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PokemonService
{
    public function getPokemonData()
    {
        $response = Http::get('https://pokeapi.co/api/v2/pokemon');
        return $response->json();
    }
}
