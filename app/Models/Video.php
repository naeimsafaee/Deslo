<?php

namespace App\Models;

use App\ClientToVideo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    protected $appends = ['slug', 'pay'];

    public function comments()
    {
        return $this->hasMany(CommentVideo::class, 'video_id', 'id')->where('is_active', '=', true);
    }

    public function category()
    {
        return $this->hasManyThrough(MusicCategory::class, CategoryToVideo::class, 'video_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'category_id' // Local key on the environments table...
        );
    }

    public function artist()
    {
        return $this->hasOne(Artist::class, 'id', 'artist_id');
    }

    public function getSlugAttribute()
    {
        return str_replace(" ", "_", $this->title);
    }

    public function scopefindWithSlug(Builder $builder, $slug)
    {
        return $builder->where('title', '=', str_replace("_", " ", $slug));
    }

    public function getPayAttribute()
    {
        if (auth()->guard('clients')->check()) {


            $is_pay = ClientToVideo::query()->where('video_id', $this->id)->where('client_id', auth()->guard('clients')->user()->id)->count();
            if ($is_pay > 0)
                return true;
            return false;
        }
        return false;
    }
}
