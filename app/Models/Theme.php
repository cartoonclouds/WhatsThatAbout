<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Eloquent;

class Theme extends Eloquent
{
    use HasFactory;

    protected $with = [
        //
    ];

    protected $withCount = [
        'segments',
    ];


    public function segments()
    {
        return $this->hasMany(Segment::class);
    }
}
