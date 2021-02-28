<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


class FeedShip extends Model
{
    protected $table = 'tbl_feeship';
    public $timestamps = false;

    public function city(){
        return $this->belongsTo('App\City', 'fee_matp');
    }
    public function dirty(){
        return $this->belongsTo(District::class, 'fee_maqh');
    }
    public function wrad(){
        return $this->belongsTo(Ward::class, 'fee_maqh');
    }

}
