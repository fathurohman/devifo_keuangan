<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $table = 'order';

    public function users()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
