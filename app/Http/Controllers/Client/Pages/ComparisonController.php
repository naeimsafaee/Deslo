<?php

namespace App\Http\Controllers\Client\Pages;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class ComparisonController extends Controller{

    public function __invoke(Request $request){

        $session = new Session();

        $products = [];

        $s_products = $session->get('products');

        if(!$s_products)
            $s_products = [];

        $attribute = [];

        foreach($s_products as $product){
            $p = Product::query()->findOrFail($product);

            foreach($p->attributes as $attr){
                $temp_attribute["value"] = $attr["text"];
                $temp_attribute["attr_id"] = $attr["attribute_id"];
                $temp_attribute["attr_text"] = $attr["parent"];

                $attribute[] = $temp_attribute;
            }

            $products[] = $p;
        }

        $attribute = array_values(array_unique($attribute , SORT_REGULAR));

//        die(json_encode($products));

        return view('client.pages.comparison', compact('products' , 'attribute'));
    }

    public function create($id){
        $product = Product::query()->findOrFail($id);

        $session = new Session();

        $session_products = $session->get('products');


        $session_products[] = $id;

        $session_products = array_unique($session_products);

        if(count($session_products) > 6)
            unset($session_products[0]);

        $session->set('products', $session_products);

        return redirect()->route('single_product', $product->slug);
    }

    public function delete($id){

        $session = new Session();

        $s_products = $session->get('products');

        if(!$s_products)
            $s_products = [];

        for($i = 0; $i < count($s_products); $i++)
            if($s_products[$i] == $id)
                unset($s_products[$i]);

        $session->set('products', $s_products);

        return redirect()->route('comparison');
    }

}
