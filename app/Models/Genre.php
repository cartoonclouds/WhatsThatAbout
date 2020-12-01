<?php

namespace App\Models;

use App\Traits\AppendModelRoutes;
use App\Traits\SimpleSluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

class Genre extends Eloquent
{
    use HasFactory;
    use SimpleSluggable;
    use AppendModelRoutes;
    use LogsActivity;

    protected $sluggableSource = 'name';

    protected static $logOnlyDirty = true;

    protected $guarded = [];

    protected $with = [
        //
    ];

    protected $withCount = [
        'pages',
        'scenes',
    ];

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function scenes()
    {
        return $this->hasMany(Scene::class);
    }
}
