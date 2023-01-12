<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class lap_offline extends Model
{
    protected $table = 'laporan_offline';

    public function users()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
