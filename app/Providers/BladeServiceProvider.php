<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /*
        |--------------------------------------------------------------------------
        | Extend blade so we can define a variable
        | <code>
        | @define($variable = "whatever")
        | </code>
        | https://stackoverflow.com/questions/13002626/how-to-set-variables-in-a-laravel-blade-template?rq=1
        |--------------------------------------------------------------------------
        */
        Blade::extend(function ($value) {
            return preg_replace('/@define(.+)/', '<?php ${1}; ?>', $value);
        });

        // Does user have any admin role blade directive
        Blade::directive('hasAdminRole', function ($value) {
            return "<?php if(auth()->check() && auth()->user()->hasAnyRole('" . collect([
                    \App\Models\User::ROLE_SUPER_ADMIN,
                    \App\Models\User::ROLE_ADMIN,
                    \App\Models\User::ROLE_MOD
                ])->implode('|') . "')): ?>";
        });

        Blade::directive('endHasAdminRole', function ($value) {
            return '<?php endif; ?>';
        });
    }
}
