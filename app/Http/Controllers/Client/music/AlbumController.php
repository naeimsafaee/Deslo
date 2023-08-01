<?php

namespace App\Http\Controllers\Client\music;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\CategoryToMusic;
use App\Models\Music;
use App\Models\MusicCategory;
use Illuminate\Http\Request;

class AlbumController extends Controller {

    public function __invoke(Request $request) {
        $categories = MusicCategory::all();
        $albums = Album::query()->paginate(35);
        $is_category = true;

        return view('client.music.all_album', compact('categories', 'albums', 'is_category'));
    }

    public function category(Request $request, $id) {
        $is_category = false;
        $categories = MusicCategory::all();

        $albums = Album::query()->whereHas('category', function($q) use ($id) {
            $q->where('category_id', $id);
        })->paginate(35);

        $music_category = MusicCategory::query()->findOrFail($id);

//        die(json_encode($music_category));

        return view('client.music.all_album', compact('categories', 'albums', 'is_category', 'music_category'));
    }

}
