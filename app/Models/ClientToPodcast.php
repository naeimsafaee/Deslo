<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientToPodcast extends Model {
    use HasFactory;

    protected $fillable = ['client_id', 'podcast_id'];

}
