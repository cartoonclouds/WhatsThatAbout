<?php

namespace App\Models;

use App\Contracts\Commentable;
use App\Contracts\Votable;
use App\Traits\SimpleSluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Page extends Eloquent implements Commentable, Votable
{
    use HasFactory;
    use SimpleSluggable;
    use SoftDeletes;
    use LogsActivity;

    protected $sluggableSource = 'title';

    protected static $logOnlyDirty = true;

    protected $guarded = [];

    protected $casts = [ // object
        'references' => 'array', // {imdb_id: tt0123456}, wikipedia_url: '', official_website_url: ''} http://www.imdb.com/title/tt0123456/
    ];

    protected $with = [
        'votes',
        'creator',
        'genre',
        'format',
    ];

    protected $withCount = [
        'comments',
        'scenes',
        'votes',
    ];

    protected $appends = [
        'url',
    ];

    protected $dates = [
        'release_year'
    ];

    public function getUrlAttribute()
    {
        return url($this->getRouteKey());
    }


    public function getTitleAttribute()
    {
        return ucwords($this->attributes['title'] ?? '');
    }


    public static function findOrFail($id, $columns = ['*'])
    {
        return static::where('slug', $id)->firstOrFail($columns);
    }


    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


    public function scenes()
    {
        return $this->hasMany(Scene::class);
    }


    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }


    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'deleted' => "<span class='text-muted font-italic'>user deleted</span>"
        ]);
    }


    public function genre()
    {
        return $this->belongsTo(Genre::class)->withDefault([
            'deleted' => "<span class='text-muted font-italic'>genre deleted</span>"
        ]);
    }


    public function format()
    {
        return $this->belongsTo(Format::class)->withDefault([
            'deleted' => "<span class='text-muted font-italic'>format deleted</span>"
        ]);
    }
}
