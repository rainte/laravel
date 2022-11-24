# laravel

## 1. 发布配置文件.

```
php artisan vendor:publish --provider="Rainte\Laravel\Providers\RainteServiceProvider"
```

## 2. 注册服务提供者.

config/app.php

```
'providers' => [
    ...
    Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,
    Rainte\Laravel\Providers\AppServiceProvider::class,
    Rainte\Laravel\Providers\AuthServiceProvider::class,
    Rainte\Laravel\Providers\DBBuilderServiceProvider::class,
    Rainte\Laravel\Providers\DBLogServiceProvider::class,
    Rainte\Laravel\Providers\ExceptionServiceProvider::class,
    Rainte\Laravel\Providers\PaginatorServiceProvider::class,
    Rainte\Laravel\Providers\RouteServiceProvider::class,
]
```

## 3. 注册中间件.

app/Http/Kernel.php

```
protected $middlewareGroups = [
    ...
    'api' => [
        'throttle:api',
        // \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Rainte\Laravel\Http\Middleware\FormaterResponse::class,
    ],
];

protected $routeMiddleware = [
    ...
    'auth' => \Rainte\Laravel\Http\Middleware\Authenticate::class,
];
```
