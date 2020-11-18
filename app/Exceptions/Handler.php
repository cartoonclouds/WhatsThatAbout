<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function report(Throwable $exception)
    {
        if ($this->shouldReport($exception) && app()->bound('sentry')) {
            app('sentry')->configureScope(function (\Sentry\State\Scope $scope): void {
                $scope->setUser([
                    'id' => user()->id,
                    'username' => user()->username,
                    'email' => user()->email,
                    'ip_address' => request()->ip(),
                ]);
            });

            app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }
}
