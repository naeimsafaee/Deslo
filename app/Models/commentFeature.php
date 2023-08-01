<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class commentFeature extends Model
{
    protected $fillable = ['comment_id', 'text' , 'is_positive'];

}
