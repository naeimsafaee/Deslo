<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model{

    protected $appends = ['parent' , 'group'];

    public function attribute(){
        return $this->hasOne(Attribute::class, 'id', 'attribute_id');
    }

    public function getParentAttribute(){
        return $this->attribute->text;
    }

    public function getGroupAttribute(){
        return $this->attribute->group->text;
    }

    public function getGroupSort(){
        return $this->attribute->group->sort;
    }

    public function getAttributeSort(){
        return $this->attribute->sort;
    }

}
