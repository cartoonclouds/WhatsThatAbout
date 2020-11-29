<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Eloquent;
use Spatie\Activitylog\Traits\LogsActivity;

class Theme extends Eloquent
{
    use HasFactory;
    use Sluggable;
    use LogsActivity;

    protected static $logOnlyDirty = true;

    protected $with = [
        //
    ];

    protected $withCount = [
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
                'source' => 'name'
            ]
        ];
    }

    public function getUrlAttribute()
    {
        return url('theme/' . $this->getRouteKey());
    }

    public function scenes()
    {
        return $this->hasMany(Scene::class);
    }
}
