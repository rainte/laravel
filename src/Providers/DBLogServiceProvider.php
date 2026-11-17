<?php

namespace Rainte\Laravel\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class DBLogServiceProvider extends ServiceProvider
{
    /**
     * @inheritdoc
     */
    public function boot()
    {
        config('app.debug') && DB::listen(function ($query) {
            $sql = str_replace('?', '"' . '%s' . '"', $query->sql);
            $sql = vsprintf($sql, $query->bindings);
            $sql = str_replace("\\", "", $sql);

            Log::debug('DB SQL', [
                'time' => $query->time . 'ms',
                'sql' => $sql,
            ]);
        });
    }
}
