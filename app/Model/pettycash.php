<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class pettycash extends Model
{
    protected $table = 'pettycash';

    public function coa()
    {
        return $this->belongsTo('App\Model\COA', 'coa_id');
    }
}
