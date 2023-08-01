<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model {

    protected $appends = [
        'slug'
    ];

    public function getSlugAttribute() {
        return str_replace(" ", "_", $this->full_name);
    }

    public function scopefindWithSlug(Builder $builder, $slug) {
        return $builder->where('full_name', '=', str_replace("_", " ", $slug));
    }

    public function albums() {
        return $this->hasMany(Album::class, 'artist_id', 'id');
    }

    public function musics() {
        return $this->hasMany(Music::class, 'artist_id', 'id');
    }

    public function podcasts() {
        return $this->hasMany(Podcast::class, 'artist_id', 'id');
    }

    public function videos() {
        return $this->hasMany(Video::class, 'artist_id', 'id');
    }
}
