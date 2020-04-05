<?php

namespace App\Models;

use Eloquent;

class Reference extends Eloquent
{
    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    public function types()
    {
        return $this->belongsToMany(Type::class);
    }

    public function shows()
    {
        return $this->belongsToMany(Show::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
