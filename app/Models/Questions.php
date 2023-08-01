<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Question\Question;

class Questions extends Model{
    protected $fillable = ['is_admin' , 'text', 'client_id', 'product_id', 'likes', 'dis_likes', 'reply_to', 'is_active'];

    public function client(){
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function getShamsiDateAttribute(){
        if(!$this->created_at)
            return "";
        $date = jdate($this->created_at);
        $date = substr($date, 0, strpos($date, " "));

        $date = explode("-", $date);

        switch($date[1]){
            case 1:
                $date[1] = "فروردین";
                break;
            case 2:
                $date[1] = "اردیبهشت";
                break;
            case 3:
                $date[1] = "خرداد";
                break;
            case 4:
                $date[1] = "تیر";
                break;
            case 5:
                $date[1] = "مرداد";
                break;
            case 6:
                $date[1] = "شهریور";
                break;
            case 7:
                $date[1] = "مهر";
                break;
            case 8:
                $date[1] = "آبان";
                break;
            case 9:
                $date[1] = "آذر";
                break;
            case 10:
                $date[1] = "دی";
                break;
            case 11:
                $date[1] = "بهمن";
                break;
            case 12:
                $date[1] = "اسفند";
                break;
        }

        return implode(" ", $date);
    }

    public function reply(){
        return Questions::query()->where('reply_to', $this->id)->get();
    }

    public function scopeIsAdmin($query){
        return $query->where('reply_to', 0)->groupBy('client_id')->havingRaw('count("client_id") > 0');
    }

    public function scopeActive($query){
        return $query->where('is_active', 1);
    }
}
