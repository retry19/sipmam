<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $guarded = [];

    const TAX = 1;

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

    public function transaksi()
    {
        return $this->hasOne('App\Transaksi', 'pesanan_id');
    }

    public function getTotalHargaFormatAttribute()
    {
        return 'Rp. '.number_format($this->total_harga, 2, ',', '.');
    }

    public function getDateFormatAttribute()
    {
        return $this->created_at->format('d-m-Y');
    }
}
