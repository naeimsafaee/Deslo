<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGroupCategory extends Model{

    public function subcategories(){
        return $this->hasMany(ProductSubCategory::class , 'group_category_id' , 'id');
    }

}
