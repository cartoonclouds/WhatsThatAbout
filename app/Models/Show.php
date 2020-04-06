<?php

namespace App\Models;

use Eloquent;

class Show extends Eloquent
{
    protected $casts = [
        'references' => 'array', // {imdb_id: tt0123456}, wikipedia_url: '', official_website_url: ''} http://www.imdb.com/title/tt0123456/
        'is_published' => 'boolean'
    ];

    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    public function references()
    {
        return $this->belongsToMany(Reference::class);
    }

    public function rating()
    {
        return $this->belongsTo(Rating::class, 'rate_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
