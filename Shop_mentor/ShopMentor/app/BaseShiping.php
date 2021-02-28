<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


class BaseShiping extends Model
{
    protected $table = 'shipping';
    public $timestamps = false;

    public function order(){
        return $this->hasMany(BaseOrder::class);
    }
}
