<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionAlbum extends Model{

    protected $fillable = [
        'transaction_id',
        'album_id',
    ];


}
