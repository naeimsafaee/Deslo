<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryToAlbum extends Model
{
    public function album(){
        return $this->hasOne(Album::class , 'id' , 'album_id');
    }
}
