<?php

namespace App\Models;

use Eloquent;

class Genre extends Eloquent
{
    public function shows()
    {
        return $this->belongsToMany(Show::class);
    }
}
