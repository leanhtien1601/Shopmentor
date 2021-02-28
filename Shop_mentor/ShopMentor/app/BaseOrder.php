<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


class BaseOrder extends Model
{
    protected $table = 'order';
    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function shipping()
    {
        return $this->belongsTo(BaseShiping::class, 'shipping_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}
