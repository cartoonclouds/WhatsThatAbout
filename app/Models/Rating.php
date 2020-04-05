<?php

namespace App\Models;

use Eloquent;

class Rating extends Eloquent
{
    public function shows()
    {
        return $this->belongsToMany(Show::class);
    }
}
