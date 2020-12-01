<?php

namespace App\Models;

use App\Traits\AppendModelRoutes;
use App\Traits\SimpleSluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Format extends Model
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
    ];

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
