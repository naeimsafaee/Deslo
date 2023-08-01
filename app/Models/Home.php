<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Home extends Model{

    protected $appends = ['products'];

    public function getProductsAttribute(){

        if($this->sub_category_id){
            /*$p = $this->hasManyThrough(
                Product::class,
                ProducToProducttSubCategory::class,
                "subcategory_id",
                "id",
                "sub_category_id",
                "product_id"
            );*/

            $sub_category = $this->sub_category_id;
            $p = Product::query()->whereHas('categories' , function(Builder $query) use($sub_category) {
                $query->where('subcategory_id' , $sub_category);
            });
            if($this->is_desc){
                $p->orderByDesc('updated_at');
            } else {
                $p->orderBy('updated_at');
            }

            return $p->take($this->count)->get();
        }
        return "";
    }

    public function albums(){

        if($this->artist_id){
            $album = $this->hasMany(Album::class, "artist_id", "artist_id");

            if($this->is_desc){
                $album->orderByDesc('updated_at');
            } else {
                $album->orderBy('updated_at');
            }

            return $album->take($this->count);
        }

    }


    public function items(){
        $items = [];
        if($this->type == "service"){

            $items = Service::query()->limit(4)->get();

        } elseif($this->type == "product") {

            if($this->sub_category_id){
                $items = $this->products;
            } else {

                if($this->is_desc){
                    $items = Product::query()->where('is_book', 0)->orderByDesc('updated_at')->take($this->count)->get();
                } else {
                    $items = Product::query()->where('is_book', 0)->orderByDesc('updated_at')->take($this->count)->get();
                }
            }


        } elseif($this->type == "album") {

            if($this->artist_id){
                $items = $this->albums;
            } else {
                if($this->is_desc){
                    $items = Album::query()->orderByDesc('updated_at')->take($this->count)->get();
                } else {
                    $items = Album::query()->orderBy('updated_at')->take($this->count)->get();
                }
            }
        } elseif($this->type == "brand") {
            $items = Brand::query()->take($this->count)->get();
        } elseif($this->type == "banner") {
            $items = Banner::query()->take($this->count)->get();
        } elseif($this->type == "banner2") {
            $items = Banner2::query()->take($this->count)->get();
        } elseif($this->type == "blog") {
            $blog = Blog::query();
            if($this->is_desc){
                $items = $blog->orderByDesc('updated_at')->take($this->count)->get();
            } else {
                $items = $blog->orderBy('updated_at')->take($this->count)->get();
            }
        } elseif($this->type == 'book') {
            $items = Product::query()->where('is_book', 1)->orderByDesc('updated_at')->take($this->count)->get();
        }

        return $items;
    }
}
