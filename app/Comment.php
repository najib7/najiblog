<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // user rolatioship
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // post relationship
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
