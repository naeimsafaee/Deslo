<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regulate extends Model
{
    protected $appends = ['shamsi_date'];

    protected $fillable = ['full_name' , 'phone' , 'model' , 'date' , 'serial' ,
        'type' ,'address' , 'town_id' , 'city_id' , 'client_id'];

    public function getShamsiDateAttribute(){
        if(!$this->created_at)
            return "";
        $date = jdate($this->created_at);
        $date = substr($date , 0 , strpos($date , " "));

        $date = explode("-" , $date);

        return implode("/" , $date);
    }

    public function town(){
        return $this->hasOne(Province::class, 'id', 'town_id');
    }

    public function statusShow() {
        if ($this->status == config('Constants.regulate_status.pending')) {
            return 'در انتظار تایید';
        }else if ($this->status == config('Constants.regulate_status.accepted')) {
            return 'تایید شده';
        }else if ($this->status == config('Constants.regulate_status.rejected')) {
            return 'رد شده';
        }
        return '';
    }
    public function statusClass() {
        if ($this->status == config('Constants.regulate_status.rejected')) {
            return 'red';
        }
        return '';
    }
}
