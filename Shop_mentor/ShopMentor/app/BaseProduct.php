<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseProduct extends Model
{
    protected $table = 'product';
    public $timestamps = false;
    protected $primaryKey = 'id';

    public function category()
    {
        return $this->belongsTo(BaseCategory::class, 'category_id');
    }

    public function image(){
        return $this->hasMany(BaseImageProduct::class,'product_id','id');
    }

    public function wishList()
    {
        return $this->hasOne(WishList::class);
    }

}
