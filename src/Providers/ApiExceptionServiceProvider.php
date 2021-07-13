<?php

namespace Mojtabarks\ApiExceptions\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * @codeCoverageIgnore
 */
class ApiExceptionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap package services.
     *
     * @return void
     */
    public function boot()
    {

        $this->publishes([
            __DIR__ . '/../lang' => resource_path('lang/vendor/errors'),
        ]);

        $this->publishes([
            __DIR__.'/../config/exceptions.php' => config_path('exceptions.php'),
        ]);

        $this->mergeConfigFrom(
            __DIR__ . '/../config/exceptions.php' , 'exceptions'
        );

        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'errors');
    }
}
