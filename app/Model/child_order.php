<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class child_order extends Model
{
    protected $table = 'child_order';


    public function barangs()
    {
        return $this->belongsTo('App\Model\barangs', 'barangs_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Model\order', 'order_id');
    }
}
