<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Eloquent;

class Category extends Eloquent
{
    use HasFactory;

    public function segments()
    {
        return $this->hasMany(Segment::class);
    }
}
