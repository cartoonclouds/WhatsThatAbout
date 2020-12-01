<?php

namespace App\Traits;

trait AppendModelRoutes
{

    public function getUrlAttribute()
    {
        return url(rtrim($this->getTable(), 's') . '/' . $this->getRouteKey());
    }

    public function getModelTypeAttribute()
    {
        return get_class($this);
    }

    public function getExistsAttribute()
    {
        return $this->exists;
    }

    public function bootModelUrls()
    {
        $this->setAppends([
            'url',
            'exists',
            'model_type',
        ]);
    }
}
