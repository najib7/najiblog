<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // user relationship
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
