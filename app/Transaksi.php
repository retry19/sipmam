<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $guarded = [];

    public function pesanan()
    {
        return $this->belongsTo('App\Pesanan', 'pesanan_id');
    }
}
