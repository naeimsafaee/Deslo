<?php

namespace App\Http\Controllers\Client\music;

use App\Http\Controllers\Controller;
use App\Models\Artist;

class ArtistController extends Controller
{
    public function __invoke($slug){

        $artist = Artist::findWithSlug($slug)->first();

        $products = new \Illuminate\Database\Eloquent\Collection;
        $products = $products->merge($artist->albums)->merge($artist->musics);
        $products = $products->merge($artist->musics);
        $products = $products->merge($artist->podcasts);
        $products = $products->merge($artist->videos);
//        die(json_encode($products));
        return view('client.music.artist' , compact('artist' , 'products'));
    }
}
