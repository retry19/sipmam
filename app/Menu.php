<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    public $timestamps = false;

    public function detailPesanan()
    {
        return $this->hasMany('App\DetailPesanan', 'menu_id');
    }
}
