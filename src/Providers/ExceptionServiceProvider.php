<?php

namespace Rainte\Laravel\Providers;

use Illuminate\Support\ServiceProvider;

class ExceptionServiceProvider extends ServiceProvider
{
    /**
     * @inheritdoc
     */
    public function register()
    {
        $this->app->singleton(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            \Rainte\Laravel\Exceptions\Handler::class
        );
    }
}
