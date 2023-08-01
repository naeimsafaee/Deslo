<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;

class Blog extends Model {
    use Resizable;

    protected $appends = ['short_desc', 'shamsi_date', 'slug'];

    public function getShortDescAttribute() {
        $str = $this->clean(substr($this->description, 0, 220));
        return strip_tags((substr($str, 0, strrpos($str, " ")))) . "....";
    }

    public function getShamsiDateAttribute() {
        if (!$this->created_at)
            return "";
        $date = jdate($this->created_at);
        $date = substr($date, 0, strpos($date, " "));

        $date = explode("-", $date);

        return implode("/", $date);
    }

    public function categories() {
        return $this->belongsToMany(
            BlogCategory::class,
            BlogToBlogCategory::class,
            'blog_id',
            'blogcategory_id'
        );
    }

    public function getSlugAttribute() {
        return str_replace(" ", "_", $this->title);
    }

    public function scopefindWithSlug(Builder $builder, $slug) {
        return $builder->where('title', '=', str_replace("_", " ", $slug));
    }

    private function clean($str) {
        return str_replace("&nbsp;", "", $str);
    }

}
