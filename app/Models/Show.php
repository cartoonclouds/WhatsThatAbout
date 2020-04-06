<?php

namespace App\Models;

use Eloquent;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Show extends Eloquent
{
    use HasSlug;

    protected $casts = [ // object
        'references' => 'array', // {imdb_id: tt0123456}, wikipedia_url: '', official_website_url: ''} http://www.imdb.com/title/tt0123456/
        'is_published' => 'boolean'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50);
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

    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    public function references()
    {
        return $this->hasMany(Reference::class);
    }

    public function ratings()
    {
        return $this->belongsToMany(Rating::class);
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
