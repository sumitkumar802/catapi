<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CatController extends Controller
{
    //
    public function index(Request $request) {      
        $apiKey = env('CAT_API_KEY');
        $limit = $request->get('limit', 9);
        $breedId = $request->get('breed', '');

        $breedResponse = Http::get("https://api.thecatapi.com/v1/breeds");
        $breeds = $breedResponse->json();

        $url = "https://api.thecatapi.com/v1/images/search?limit={$limit}&api_key={$apiKey}&mime_types=jpg,png";
        if ($breedId) {
            $url .= "&breed_ids={$breedId}";
        }
        $catResponse = Http::get($url);
        $cats = $catResponse->json();

        return view('cats.index', compact('cats', 'breeds'));
    }
}
