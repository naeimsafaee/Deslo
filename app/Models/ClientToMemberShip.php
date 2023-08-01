<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientToMemberShip extends Model{

    protected $fillable = [
        'client_id',
        'membership_id',
    ];

}
