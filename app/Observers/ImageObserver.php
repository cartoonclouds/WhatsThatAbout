<?php

namespace App\Observers;

use App\Models\Image;
use App\Models\User;

class ImageObserver
{
    /**
     * Handle the Image "saved" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function saved(Image $image)
    {
        if (get_class($image->imageable) === User::class) {
            // a page/segment can only have one COVER image
            if ($image->cover) {
                $image->imageable->images()->where('id', '!=', $image->id)->update(['cover' => false]);
            }

            // a page/segment can only have one HERO image
            if ($image->hero) {
                $image->imageable->images()->where('id', '!=', $image->id)->update(['hero' => false]);
            }
        }
    }
}
