<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model{

    protected $fillable = [
        'client_id',
        'product_id',
        'product_type',
        'ip',
        'count',
    ];

    protected $appends = [ 'product_price' , 'is_discounted'];

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function getProductPriceAttribute(){
        if ($this->product) {
            return $this->product->final_price * $this->count;
        }else {
            return 0;
        }
    }

    public function getIsDiscountedAttribute(){
        if($this->discount_id != 0){
            $discount = Discount::query()->where('id' , '=' , $this->discount_id)->where('expire_date', '>', Carbon::today())->get();
            if($discount->count() > 0)
                return true;
            else
                return "invalid";
        }
        return false;
    }

}
