<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Present extends Model
{
    protected $table = 'present';

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
