<?php

namespace Liateam\ApiException\Providers;

use Illuminate\Support\ServiceProvider;

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
            __DIR__ . '/config/exceptions.php' => config_path('exceptions.php'),
        ]);
    }
}
