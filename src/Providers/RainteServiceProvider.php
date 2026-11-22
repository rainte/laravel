<?php

namespace Rainte\Laravel\Providers;

use Illuminate\Support\ServiceProvider;

class RainteServiceProvider extends ServiceProvider
{
    /**
     * @inheritdoc
     */
    public function boot()
    {
        $this->config();
    }

    protected function config()
    {
        $path = realpath(__DIR__ . '/../Config/rainte.php');

        $this->publishes([$path => config_path('rainte.php')], 'config');
        $this->mergeConfigFrom($path, 'rainte');
    }
}
