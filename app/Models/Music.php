<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    public function comments(){
        return $this->hasMany(CommentMusic::class, 'music_id' , 'id')
            ->where('is_active' , '=' , true);
    }

    public function artist(){
        return $this->belongsToMany(Artist::class , ArtistToMusic::class);
    }

    public function music(){
        return $this->belongsToMany(
            Album::class,
            AlbumToMusic::class
        );
    }

    public function category(){
        return $this->hasManyThrough(
            MusicCategory::class,
            CategoryToMusic::class,
            'music_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'category_id' // Local key on the environments table...
        );
    }
    public function getSlugAttribute(){
        return str_replace(" ", "_", $this->title);
    }
    public function scopefindWithSlug(Builder $builder , $slug){
        return $builder->where('title' , '=' , str_replace("_" , " " , $slug));
    }
}
