<?php

namespace App\Http\Controllers\Client\Pages;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Brand;
use App\Models\Color;
use App\Models\MusicCategory;
use App\Models\PianoType;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SearchController extends Controller {

    public function __invoke(Request $request) {

        if ($request->search_in == 'products' || $request->search_in == 'books' || !isset($request->search_in)) {
            $products = Product::query();

            if (isset($request->search)) {
                $products->where('name', 'like', '%' . $request->search . '%')->orWhere('sub_title', 'like', '%' . $request->search . '%')->orWhere('short_description', 'like', '%' . $request->search . '%');
            }

            if (isset($request->type)) {
                $products->where('piano_type_id', $request->type);
            }
            if (isset($request->colors)) {
                $colors = explode('-', $request->colors);
                $products->whereHas('colors', function(Builder $query) use ($colors) {
                    $query->whereIn('colors.id', $colors);
                });
            }

            if (isset($request->category)) {
                $category_id = $request->category;
                $products->whereHas('categories', function(Builder $query) use ($category_id) {
                    $query->where('product_sub_categories.id', $category_id);
                });
            }

            if (isset($request->price_range)) {
                $price = explode(';', $request->price_range);
                if (count($price) == 2) {
                    $products->where('price', '>=', $price[0])->where('price', '<=', $price[1]);
                }
            }
            if (isset($request->brand)) {
                $products->whereIn('brand_id', $request->brand);
            }
            if (isset($request->availability) && $request->availability == 1) {
                $products->where('stock', '>', 0);
            }
            $categories = [];

            if ($request->sort != 'books' && ($request->search_in == 'products' || !isset($request->search_in))) {
                $products->where('is_book', 0);
            } else if ($request->search_in == 'books') {
                $category = ProductCategory::query()->findOrFail(8);
                foreach($category->groups as $group) {
                    foreach($group->subcategories as $sub_category) {
                        $categories[] = $sub_category;
                    }
                }
                $products->where('is_book', 1);
            }

            if ($request->sort == 'expensive') {
                $products->orderBy('price', 'DESC');
            } else if ($request->sort == 'cheap') {
                $products->orderBy('price', 'ASC');
            } else if ($request->sort == 'popular') {
                $products->orderBy('rate', 'DESC');
            } else if ($request->sort == 'used') {
                $products->where('is_used', 1);
            } else if ($request->sort == 'discounts') {
                $products->where('discounted_price', '<>', 0);
            } else if ($request->sort == 'books') {
                $products->where('is_book', 1);
            } else {
                $products->orderBy('created_at', 'DESC');
            }

            $products = $products->paginate(12);
            $brands = Brand::all();
            $types = PianoType::all();
            $colors = Color::all();
            return view('client.pages.search', compact('products', 'brands', 'types', 'colors', 'categories'));
        } else if ($request->search_in == 'albums') {
            $category = null;
            $categories = MusicCategory::all();
            $albums = Album::query()->where('title', 'like', '%' . $request->search . '%')->paginate(35);
            return view('client.music.all_music', compact('albums', 'categories', 'category'));
        } else if ($request->search_in == 'blog') {
            return redirect()->route('blogs', ['search' => $request->search, 'search_in' => 'blog']);
        }

    }
}
