<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    protected $fillable = ['is_like' , 'question_id' , 'client_id'];
}
