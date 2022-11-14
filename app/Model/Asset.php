<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $table = 'assets';

    public function coa()
    {
        return $this->belongsTo('App\Model\COA', 'coa_id');
    }

    public function barang()
    {
        return $this->belongsTo('App\Model\nama_barang', 'barang_id');
    }
}
