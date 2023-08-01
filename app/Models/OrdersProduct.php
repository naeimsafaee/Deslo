<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersProduct extends Model
{
    public function transaction()
    {
        return $this->hasOne(Transaction::class , 'id' , 'transaction_id');
    }
}
