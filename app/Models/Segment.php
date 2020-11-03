<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Segment extends Eloquent
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [ // object
        'references' => 'array', // {imdb_id: tt0123456}, wikipedia_url: '', official_website_url: ''} http://www.imdb.com/title/tt0123456/
        'runs_throughout' => 'boolean',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
