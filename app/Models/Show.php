<?php

namespace App\Models;

use Eloquent;

class Show extends Eloquent
{
    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    public function references()
    {
        return $this->belongsToMany(Reference::class);
    }

    public function ratings()
    {
        return $this->belongsToMany(Rating::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
