<?php

namespace App\Http\Controllers\Client\Artists;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function __invoke(Request $request)
    {
        $artists = Artist::paginate(35);
        return view('client.artists.artists' , compact('artists'));
    }
}
