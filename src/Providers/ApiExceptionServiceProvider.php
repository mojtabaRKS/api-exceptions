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
            __DIR__ . '/../config/exceptions.php' => config_path('exceptions.php'),
        ]);
    }
}
