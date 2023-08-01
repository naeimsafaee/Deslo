<?php

namespace App\Http\Controllers\Client\music;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\CategoryToMusic;
use App\Models\Music;
use App\Models\MusicCategory;
use App\Models\Podcast;
use App\Models\Video;
use Illuminate\Http\Request;

class AllMusicController extends Controller {

    public function __invoke(Request $request, $id = false) {
        $categories = MusicCategory::all();
        if ($id == false) {
            $albums = Album::query()->paginate(35);
            $musics = Music::query()->whereDoesntHave('music')->take(14)->get();
            $category = false;

        } else {
            $albums = Album::query()->whereHas('category', function($q) use ($id) {
                $q->where('category_id', $id);
            })->paginate(35);

            $musics = CategoryToMusic::query()->where('category_id', '=', $id)
                ->with('music')->take(14)->get()->map(function($musics) {
                    return $musics->music;
                });
            $category = MusicCategory::query()->findOrFail($id);
        }
        $podcasts = Podcast::query()->limit(4)->get();
        $videos = Video::query()->limit(4)->get();

        return view('client.music.all_music', compact('albums', 'category', 'categories', 'podcasts', 'videos', 'musics'));
    }

}
