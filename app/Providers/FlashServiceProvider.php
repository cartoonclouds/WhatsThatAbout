<?php

namespace App\Providers;

use Laracasts\Flash\FlashServiceProvider as FlashServiceProviderBase;

class FlashServiceProvider extends FlashServiceProviderBase
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();;

        \Flash::macro('test', function($v) {
            dd($v, $this);
        });
    }
}
