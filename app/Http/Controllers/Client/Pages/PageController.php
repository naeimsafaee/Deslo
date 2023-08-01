<?php

namespace App\Http\Controllers\Client\Pages;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller{

    public function __invoke(Request $request, $slug){
        $page = Page::query()->where('slug', $slug)->firstOrFail();
        return view('client.pages.pages', compact('page'));
    }
}
