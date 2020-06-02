<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = [];

    public function pesanan()
    {
        return $this->belongsTo('App\Pesanan', 'pesanan_id');
    }
}
