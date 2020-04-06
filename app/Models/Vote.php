<?php

namespace App\Models;

use Eloquent;

class Vote extends Eloquent
{
    public function votable()
    {
        return $this->morphTo();
    }

    //distinguish between Reference and Show morphs

    //use get/set attributes to enforce a correct vote


    public function voter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
