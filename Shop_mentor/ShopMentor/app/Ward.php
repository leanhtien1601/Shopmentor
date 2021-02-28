<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


class Ward extends Model
{
    protected $table = 'tbl_xaphuongthitran';
    public $timestamps = false;
    protected $primaryKey = 'xaid';

}
