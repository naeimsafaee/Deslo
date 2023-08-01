<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryToVideo extends Model
{
    public function video(){
        return $this->hasOne(Video::class , 'id' , 'video_id');
    }
}
