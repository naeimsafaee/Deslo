<?php

namespace App\Http\Controllers\client\music;

use App\ClientToVideo;
use App\Http\Controllers\Controller;
use App\Models\CommentVideo;
use App\Models\MusicCategory;
use App\Models\Video;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SingleVideoController extends Controller
{

    public function __invoke($slug)
    {
        $video = Video::findWithSlug($slug)->first();
        $new = Video::all()->take(4);
        $is_category = true;
        $category = false;

        return view('client.music.single_video', compact('video', 'new', 'is_category' , 'category'));
    }

    public function submit(Request $request)
    {
        CommentVideo::query()->create([
            'client_id' => auth()->guard('clients')->user()->id,
            'video_id' => $request->video_id,
            'description' => $request->description,
            'is_active' => false,
        ]);
        return redirect(url()->previous());
    }

    public function all($id = false)
    {

        $categories = MusicCategory::all();
        $is_category = true;
        $category = false;


        if ($id) {
            $videos = Video::query()->whereHas('category', function (Builder $query) use ($id) {
                $query->where('category_id', $id);
            })->get();
            $is_category = false;
            $category = MusicCategory::query()->findOrFail($id);

        } else {
            $videos = Video::all();
        }

        return view('client.music.all_video', compact('videos', 'categories', 'is_category' , 'category'));
    }

}
