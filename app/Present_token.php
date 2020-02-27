<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Present_token extends Model
{
    protected $table = 'present_token';

    public function user()
    {
        return $this->belongsTo('App\User', 'id');
    }
}
