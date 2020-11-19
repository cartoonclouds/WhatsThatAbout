<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Eloquent;

class Theme extends Eloquent
{
    use HasFactory;

    public function segments()
    {
        return $this->hasMany(Segment::class);
    }
}
