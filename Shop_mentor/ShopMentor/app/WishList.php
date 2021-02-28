<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class WishList extends Model
{
    protected $table = 'wishlist';
    public $timestamps = false;

//    public function product()
//    {
//        return $this->belongsTo(BaseProduct::class,'product_id');
//    }

    public function product(){
        return $this->belongsTo(BaseProduct::class, 'product_id');
    }

}
