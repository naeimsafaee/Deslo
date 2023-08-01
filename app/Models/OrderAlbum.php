<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAlbum extends Model
{
    protected $appends = ['shamsi_date'];


    public function album()
    {
        return $this->hasOne(Album::class, 'id', 'album_id');
    }

    public function getShamsiDateAttribute(){
        if(!$this->created_at)
            return "";
        $date = jdate($this->created_at);
        $date = substr($date , 0 , strpos($date , " "));

        $date = explode("-" , $date);

        return implode("/" , $date);
    }

}
