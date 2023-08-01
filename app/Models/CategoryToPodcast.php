<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryToPodcast extends Model
{
    public function podcast(){
        return $this->hasOne(Podcast::class , 'id' , 'podcast_id');
    }
}
