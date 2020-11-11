<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Segment extends Eloquent
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [ // object
        'references' => 'array', // {imdb_id: tt0123456}, wikipedia_url: '', official_website_url: ''} http://www.imdb.com/title/tt0123456/
        'runs_throughout' => 'boolean',
    ];

    protected $with = [
        'page',
        'comments',
        'votes',
    ];

    protected $withCount = [
        'comments',
        'votes',
    ];

    protected $appends = [
        'model_type',
        'exists',
        'url',
    ];


    public function getTitleAttribute()
    {
        return ucwords($this->attributes['title']);
    }

    public function getModelTypeAttribute()
    {
        return get_class($this);
    }

    public function getExistsAttribute()
    {
        return $this->exists;
    }

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
        return url('/segments/' . $this->getRouteKey());
    }

    public function page()
    {
        return $this->belongsTo(Page::class)->without(['segments']);
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
