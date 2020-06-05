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

    public function notification()
    {
        return $this->hasMany('App\Notification', 'pesanan_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getTotalHargaFormatAttribute()
    {
        return 'Rp. '.number_format($this->total_harga, 2, ',', '.');
    }
}
