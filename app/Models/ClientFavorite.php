<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientFavorite extends Model
{
    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
