<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = [
        //
    ];

    protected $withCount = [
        'pages',
    ];


    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
