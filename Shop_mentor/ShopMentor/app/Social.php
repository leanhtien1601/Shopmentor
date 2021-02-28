<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Social extends Model
{
    protected $timestamps = false;
    public $table = 'social';

    public function login()
    {
        return $this->belongsTo(User::class);
    }


}
