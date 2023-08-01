<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientToAlbum extends Model{

    protected $fillable = [
        'album_id' , 'client_id'
    ];


}
