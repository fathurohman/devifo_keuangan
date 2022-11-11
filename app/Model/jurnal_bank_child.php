<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class jurnal_bank_child extends Model
{
    protected $table = 'jurnal_bank_child';

    public function coa()
    {
        return $this->belongsTo('App\Model\COA', 'coa_id');
    }
}
