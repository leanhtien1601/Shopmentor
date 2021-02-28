<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class BaseCategory extends Model
{
    protected $table = 'category';
    public $timestamps = false;


    public function product(){
        return $this->hasMany(BaseProduct::class, 'category_id');
    }
}
