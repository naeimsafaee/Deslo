<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionPodcast extends Model {
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'podcast_id'
    ];

}
