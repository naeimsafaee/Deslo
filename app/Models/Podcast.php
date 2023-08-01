<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    public function comments(){
        return $this->hasMany(CommentPodcast::class, 'podcast_id' , 'id')
            ->where('is_active' , '=' , true);
    }

    public function category(){
        return $this->hasManyThrough(
            MusicCategory::class,
            CategoryToPodcast::class,
            'podcast_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'category_id' // Local key on the environments table...
        );
    }
    public function artist(){
        return $this->hasOne(Artist::class , 'id' , 'artist_id');
    }

    public function getSlugAttribute(){
        return str_replace(" ", "_", $this->title);
    }
    public function scopefindWithSlug(Builder $builder , $slug){
        return $builder->where('title' , '=' , str_replace("_" , " " , $slug));
    }
}
