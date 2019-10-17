<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //bcos comments need to have subcomments
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable')->latest();
    }


}


