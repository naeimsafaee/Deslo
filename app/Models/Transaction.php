<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Transaction extends Model{

    protected $fillable = [
        'tx_id',
        'amount',
        'transaction_date',
        'client_id',
        'paid',
        'status',
    ];

}
