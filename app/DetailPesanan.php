<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    protected $table = 'detail_pesanan';
    protected $guarded = [];
    public $timestamps = false;

    public function pesanan()
    {
        return $this->belongsTo('App\Pesanan', 'pesanan_id');
    }

    public function menu()
    {
        return $this->belongsTo('App\Menu', 'menu_id');
    }
}
