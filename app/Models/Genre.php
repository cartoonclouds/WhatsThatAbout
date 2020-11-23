<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Eloquent;

class Genre extends Eloquent
{
    use HasFactory;

    protected $guarded = [];

    protected $with = [
        //
    ];

    protected $withCount = [
        'pages',
        'segments',
    ];


    public function pages()
    {
        return $this->hasMany(Page::class);
    }


    public function segments()
    {
        return $this->hasMany(Segment::class);
    }
}
