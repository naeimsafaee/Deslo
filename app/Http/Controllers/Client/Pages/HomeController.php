<?php

namespace App\Http\Controllers\Client\Pages;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ContactUs;
use App\Models\Home;
use App\Models\Link;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller {

    public function __invoke(Request $request) {

        $homes = Home::all()->sortBy('order');

        foreach($homes as $home) {
            $home->items = $home->items();
        }
        $sliders = Slider::all();
        $links = Link::all();
        $brands = Brand::all();
        return view('client.pages.home', compact('homes', 'sliders', 'links', 'brands'));
    }

    public function main_form(Request $request) {

        ContactUs::query()->create([
            "name" => $request->name,
            "phone" => $request->phone,
            "description" => $request->description,
        ]);

        return redirect(route('home'));
    }
}
