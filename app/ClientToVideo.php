<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientToVideo extends Model
{
    protected $fillable =['video_id' , 'client_id'];
}
