<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientToInstallments extends Model{

    protected $table = "client_to_installments";

    protected $fillable = [
        'time',
        'client_id',
        'order',
        'price',
        'status'
    ];


}
