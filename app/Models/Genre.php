<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Eloquent;
use Spatie\Activitylog\Traits\LogsActivity;

class Genre extends Eloquent
{
    use HasFactory;
    use Sluggable;
    use LogsActivity;

    protected static $logOnlyDirty = true;

    protected $guarded = [];

    protected $with = [
        //
    ];

    protected $withCount = [
        'pages',
        'scenes',
    ];

    protected $appends = [
        'url'
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


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getUrlAttribute()
    {
        return url('genre/' . $this->getRouteKey());
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function scenes()
    {
        return $this->hasMany(Scene::class);
    }
}
