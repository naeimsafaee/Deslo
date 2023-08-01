<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentProduct extends Model{

    protected $appends = ['shamsi_date'];

    protected $fillable = ['client_id', 'text', 'product_id' , 'rate' , 'offer' , 'is_active'];

    public function client(){
        return $this->hasOne(Client::class , 'id' , 'client_id');
    }

    public function files(){
        return $this->hasMany(commentFile::class , 'comment_id' , 'id');
    }

    public function positives(){
        return $this->hasMany(commentFeature::class, 'comment_id', 'id')
            ->where('is_positive' , '=' , true);
    }

    public function negatives(){
        return $this->hasMany(commentFeature::class, 'comment_id', 'id')
            ->where('is_positive' , '=' , false);
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function getShamsiDateAttribute(){
        if(!$this->created_at)
            return "";
        $date = jdate($this->created_at);
        $date = substr($date, 0, strpos($date, " "));

        $date = explode("-", $date);

        $temp = $date[0];
        $date[0] = $date[2];
        $date[2] = $temp;

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

}
