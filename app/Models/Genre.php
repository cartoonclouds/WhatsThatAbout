<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Eloquent;

class Genre extends Eloquent
{
    use HasFactory;

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
