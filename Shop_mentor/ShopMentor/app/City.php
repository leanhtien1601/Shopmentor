<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


class City extends Model
{
    protected $table = 'tbl_tinhthanhpho';
    public $timestamps = false;
    protected $primaryKey = 'matp';

}
