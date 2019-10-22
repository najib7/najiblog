<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // user relationship
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
