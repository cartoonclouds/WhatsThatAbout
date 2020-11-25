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
        'scenes',
    ];


    public function scenes()
    {
        return $this->hasMany(Scene::class);
    }
}
