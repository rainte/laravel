<?php

namespace Rainte\Laravel\Providers;

use Illuminate\Support\ServiceProvider;
use Rainte\Laravel\Models\Paginator;

class PaginatorServiceProvider extends ServiceProvider
{
    /**
     * @inheritdoc
     */
    public function boot()
    {
        app()->bind('Illuminate\Pagination\LengthAwarePaginator', function ($app, $options) {
            return (new Paginator($options['items'], $options['total'], $options['perPage'], $options['currentPage'], $options['options']));
        });
    }
}
