<?php

namespace App\Models;

use Eloquent;

class Reference extends Eloquent
{
    protected $casts = [ // object
        'references' => 'array', // {imdb_id: tt0123456} http://www.imdb.com/title/tt0123456/
        'runs_throughout' => 'boolean'
    ];

    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    public function types() // cinematic_term
    {
        return $this->belongsToMany(Type::class);
    }

    public function show()
    {
        return $this->belongsTo(Show::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
