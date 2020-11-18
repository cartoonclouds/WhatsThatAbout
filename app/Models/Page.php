<?php

namespace App\Models;

use Eloquent;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Page extends Eloquent
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;
    use LogsActivity;

    protected static $logOnlyDirty = true;

    protected $guarded = [];

    protected $casts = [ // object
        'references' => 'array', // {imdb_id: tt0123456}, wikipedia_url: '', official_website_url: ''} http://www.imdb.com/title/tt0123456/
    ];

    protected $with = [
        'segments',
        'votes',
        'coverImage',
        'heroImage',
    ];

    protected $withCount = [
        'segments',
        'votes',
    ];

    protected $appends = [
        'model_type',
        'exists',
        'url',
    ];

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

    public function getTitleAttribute()
    {
        return ucwords($this->attributes['title']);
    }

    public function getUrlAttribute()
    {
        return url('/' . $this->getRouteKey());
    }

    public function segments()
    {
        return $this->hasMany(Segment::class);
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function coverImage()
    {
        return $this->morphOne(Image::class, 'imageable')->where('cover', true)->withDefault();
    }

    public function heroImage()
    {
        return $this->morphOne(Image::class, 'imageable')->where('hero', true)->withDefault();
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function format()
    {
        return $this->belongsTo(Format::class);
    }
}
