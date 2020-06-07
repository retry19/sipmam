<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $guarded = [];
    protected $keyType = 'string';

    public function pesanan()
    {
        return $this->belongsTo('App\Pesanan', 'pesanan_id');
    }
}
