<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $guarded = [];

    public function detailPesanan()
    {
        return $this->hasMany('App\DetailPesanan', 'pesanan_id');
    }
}
