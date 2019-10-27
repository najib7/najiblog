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

    // categories relationship
    public function category()
    {
        return $this->belongsTo('App\Categorie', 'cat_id');
    }

    // comments relatioship
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
