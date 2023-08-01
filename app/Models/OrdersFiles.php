<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersFiles extends Model
{
    protected $appends = ['shamsi_date'];

    public function file()
    {
        if ($this->file_type ==1){
        return $this->hasOne(Video::class, 'id', 'file_id');
        }
        else{
            return $this->hasOne(Podcast::class, 'id', 'file_id');
        }
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
