<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Menu extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    public $timestamps = false;

    public function detailPesanan()
    {
        return $this->hasMany('App\DetailPesanan', 'menu_id');
    }

    public function getFotoMenuPathAttribute()
    {
        return Storage::url($this->foto_menu);
    }
}
