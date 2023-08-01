<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionMemberShip extends Model{

    protected $fillable = [
        'transaction_id',
        'membership_id',
    ];

}
