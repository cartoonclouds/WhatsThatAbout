<?php

namespace App\Models;

use Eloquent;

class Type extends Eloquent
{
    public function references()
    {
        return $this->belongsToMany(Reference::class);
    }
}
