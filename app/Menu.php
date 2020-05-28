<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function detailPesanan()
    {
        return $this->hasMany('App\DetailPesanan', 'menu_id');
    }
}
