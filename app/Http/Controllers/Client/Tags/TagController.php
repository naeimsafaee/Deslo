<?php

namespace App\Http\Controllers\Client\Tags;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagController extends Controller{

    public function __invoke(){

        $tags = Tag::all();

        return view('client.tags.tags', compact('tags'));
    }
}
