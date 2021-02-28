<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseImageProduct extends Model
{
    protected $table = 'imageProduct';
    public $timestamps = false;

    public function productImage(){
        return $this->belongsTo(BaseProduct::class);
    }
}
