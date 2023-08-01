<?php

namespace App\Http\Controllers\Client\Product;

use App\Http\Controllers\Controller;
use App\Models\ClientFavorite;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Http\Request;

class ProductController extends Controller{

    public function __invoke($slug){


        $product = Product::findWithSlug($slug)->firstOrfail();

        $session = new Session();
        $s_products = $session->get('products');
        $is_comparing = false;
        if(is_array($s_products)){
            foreach($s_products as $comparingProudct){
                if($comparingProudct == $product->id){
                    $is_comparing = true;
                }
            }
        }


        $attributes = $product->attributes->sortBy(function($product) {
            return $product->getGroupSort();
        }, SORT_REGULAR, false)->groupBy('group');

        $attributes = $attributes->map(function($items, $key){
            return $items->sortBy(function($product) {
                return $product->getAttributeSort();
            }, SORT_REGULAR, false);
        });



        $top_attributes = $product->top_attributes;


        //        $related = Product::query()->whereHas('categories', function($q) use ($product){
        //            foreach($product->categories as $category)
        //                $q->Orwhere('subcategory_id', $category->id);
        //
        //
        //        })->where('is_book', $product->is_book)->limit(4)->get();

        if ($product->relate->count() > 0)
            $related = $product->relate;
        else {
            $related = Product::query()->whereHas('categories', function($q) use ($product){
                foreach($product->categories as $category)
                    $q->Orwhere('subcategory_id', $category->id);


            })->where('is_book', $product->is_book)->limit(4)->get();
        }

            $is_favorite = false;
        if(auth()->guard('clients')->check()){
            $is_favorite = ClientFavorite::query()->where('product_id', $product->id)->where('client_id', auth()->guard('clients')->user()->id)->exists();
        }

        $admin = null;
        if(auth()->guard('web')->check()){
            $admin = auth()->guard()->user();
        }

        $comments = $product->comments;

        if(\request()->order){
            if(\request()->order === 'جدید ترین'){
                $comments = $comments->sortByDesc('created_at')->values();
            } elseif(\request()->order === 'قدیمی ترین'){
                $comments = $comments->sortBy('created_at')->values();
            }
        }

        return view('client.product.single_product', compact('product', 'related', 'attributes', 'is_comparing', 'is_favorite', 'top_attributes', 'admin' , 'comments'));
    }

    public function toggle_bookmark(Request $request, $product_id){

        $fav = ClientFavorite::query()->where('product_id', $product_id)->where('client_id', auth()->guard('clients')->user()->id)->first();
        if($fav){
            $fav->delete();
        } else {
            $fav = new ClientFavorite();
            $fav->client_id = auth()->guard('clients')->user()->id;
            $fav->product_id = $product_id;
            $fav->save();
        }

        return response()->json(["done"], 200);
    }

}
