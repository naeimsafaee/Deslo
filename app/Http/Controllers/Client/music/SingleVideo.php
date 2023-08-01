<?php

namespace App\Http\Controllers\client\music;

use App\Http\Controllers\Controller;
use App\Models\Video;

class SingleVideo extends Controller
{
    public function __invoke($slug)
    {
        $video = Video::findWithSlug($slug)->first();
        return view('client.music.single_video' , compact('video'));
    }
}
