<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


class District extends Model
{
    protected $table = 'tbl_quanhuyen';
    public $timestamps = false;
    protected $primaryKey = 'maqh';

}
