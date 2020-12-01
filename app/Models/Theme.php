<?php

namespace App\Models;

use App\Traits\AppendModelRoutes;
use App\Traits\SimpleSluggable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Eloquent;
use Spatie\Activitylog\Traits\LogsActivity;

class Theme extends Eloquent
{
    use HasFactory;
    use SimpleSluggable;
    use AppendModelRoutes;
    use LogsActivity;

    protected static $logOnlyDirty = true;

    protected $guarded = [];

    protected $sluggableSource = 'name';

    protected $with = [
        //
    ];

    protected $withCount = [
        'scenes',
    ];

    protected $appends = [
        //
    ];


    public function scenes()
    {
        return $this->hasMany(Scene::class);
    }
}
