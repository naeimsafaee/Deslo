<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionMusic extends Model {
    use HasFactory;

    protected $table = 'transaction_music';

    protected $fillable = [
        'transaction_id',
        'music_id',
    ];

}
