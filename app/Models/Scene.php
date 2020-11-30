<?php

namespace App\Models;

use App\Contracts\Commentable;
use App\Contracts\Votable;
use App\Traits\AppendModelRoutes;
use App\Traits\SimpleSluggable;
use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Scene extends Eloquent implements Commentable, Votable
{
    use HasFactory;
    use SoftDeletes;
    use SimpleSluggable;
    use AppendModelRoutes;
    use LogsActivity;

    protected $sluggableSource = 'title';

    protected static $logOnlyDirty = true;

    protected $guarded = [];

    protected $casts = [ // object
        'references' => 'array', // {imdb_id: tt0123456}, wikipedia_url: '', official_website_url: ''} http://www.imdb.com/title/tt0123456/
        'runs_throughout' => 'boolean',
    ];

    protected $with = [
        'votes',
        'genre',
        'theme',
        'creator',
    ];

    protected $withCount = [
        'comments',
        'votes',
    ];


    public function getTitleAttribute()
    {
        return ucwords($this->attributes['title'] ?? '');
    }


    public static function findOrFail($id, $columns = ['*'])
    {
        return static::where('slug', $id)->firstOrFail($columns);
    }


    public function page()
    {
        return $this->belongsTo(Page::class)->withDefault([
            'deleted' => "<span class='text-muted font-italic'>page deleted</span>"
        ]);
    }


    public function genre()
    {
        return $this->belongsTo(Genre::class)->withDefault([
            'deleted' => "<span class='text-muted font-italic'>genre deleted</span>"
        ]);
    }


    public function theme()
    {
        return $this->belongsTo(Theme::class)->withDefault([
            'deleted' => "<span class='text-muted font-italic'>theme deleted</span>"
        ]);
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
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'deleted' => "<span class='text-muted font-italic'>creator deleted</span>"
        ]);
    }

}
