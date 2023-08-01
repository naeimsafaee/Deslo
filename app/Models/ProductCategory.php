<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model{


    public function groups(){
        return $this->hasMany(ProductGroupCategory::class , 'category_id' , 'id');
    }

}
