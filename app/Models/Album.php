<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{

    public function comments(){
        return $this->hasMany(CommentAlbum::class, 'album_id' , 'id')
            ->where('is_active' , '=' , true);
    }

    public function artist(){
        return $this->belongsToMany(Artist::class,ArtistToAlbum::class);
    }

    public function music(){
        return $this->hasManyThrough(
            Music::class,
            AlbumToMusic::class,
            'album_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'music_id' // Local key on the environments table...
        );
    }

    public function category(){
        return $this->hasManyThrough(
            MusicCategory::class,
            CategoryToAlbum::class,
            'album_id', // Foreign key on the environments table...
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
