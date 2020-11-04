<?php

namespace App\Models;

use Eloquent;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Eloquent
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [ // object
        'references' => 'array', // {imdb_id: tt0123456}, wikipedia_url: '', official_website_url: ''} http://www.imdb.com/title/tt0123456/
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable() {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getUrlAttribute()
    {
        return url('pages/' . $this->getRouteKey());
    }

    public function segments()
    {
        return $this->hasMany(Segment::class);
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
