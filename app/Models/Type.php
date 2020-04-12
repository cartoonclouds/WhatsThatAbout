<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Eloquent
{
    use SoftDeletes;

    public function references()
    {
        return $this->belongsToMany(Reference::class);
    }
}
