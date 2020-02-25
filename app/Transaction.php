<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
