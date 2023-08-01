<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ["title" ,"full_name" , 'postal_code' , 'address' , 'town_id' , 'city_id' , 'client_id'];

    public function town(){
        return $this->hasOne(Province::class , 'id' , 'town_id');
    }

    public function city(){
        return $this->hasOne(City::class , 'id' , 'city_id');
    }
}
