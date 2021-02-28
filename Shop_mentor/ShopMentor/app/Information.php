<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


class Information extends Model
{
    protected $table = 'setting';
    public $timestamps = false;
    protected $primaryKey = 'id';

}
