<?php

namespace App\Http\Controllers\client\music;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\CategoryToAlbum;
use App\Models\CategoryToMusic;
use App\Models\CategoryToPodcast;
use App\Models\CategoryToVideo;
use App\Models\Music;
use App\Models\MusicCategory;
use App\Models\Podcast;
use App\Models\Video;
use Illuminate\Http\Request;


class MusicController extends Controller{

    public function __invoke(Request $request){
        $categories = MusicCategory::all();
        $musics = Music::all();
        $is_category = true;

        return view('client.music.musics', compact('categories',  'musics' , 'is_category'));
    }

    public function category(Request $request, $id){
        $is_category = false;
        $categories = MusicCategory::all();


        $musics = CategoryToMusic::query()->where('category_id', '=', $id)
            ->with('music')->get()->map(function($musics){
                return $musics->music;
            });


        $music_category = MusicCategory::query()->findOrFail($id);

//        die(json_encode($music_category));

        return view('client.music.musics', compact('categories',  'musics', 'music_category' , 'is_category'));
    }
}
