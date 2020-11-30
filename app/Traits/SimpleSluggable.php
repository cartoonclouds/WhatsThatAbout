<?php

namespace App\Traits;

use Cviebrock\EloquentSluggable\Sluggable;

trait SimpleSluggable
{
    use Sluggable;

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => $this->sluggableSource
            ]
        ];
    }
}
