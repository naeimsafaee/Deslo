<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryToMusic extends Model
{
    public function music(){
        return $this->hasOne(Music::class , 'id' , 'music_id');
    }
}
