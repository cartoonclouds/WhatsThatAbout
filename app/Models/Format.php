<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Format extends Model
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
        return url('format/' . $this->getRouteKey());
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
