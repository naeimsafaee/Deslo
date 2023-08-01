<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model{

    protected $appends = ['group_text'];

    public function group(){
        return $this->hasOne(GroupAttribute::class, 'id', 'group_attribute_id');
    }

    public function getGroupTextAttribute(){
        return $this->group->text;
    }

}
