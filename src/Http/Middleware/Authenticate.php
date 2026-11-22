<?php

namespace Rainte\Laravel\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Rainte\Laravel\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as Http;

class Authenticate extends Middleware
{
    /**
     * @inheritdoc
     */
    protected function redirectTo($request)
    {
    }

    /**
     * @inheritdoc
     */
    protected function unauthenticated($request, array $guards)
    {
        Exception::fail('请登录.', Http::HTTP_UNAUTHORIZED, Http::HTTP_UNAUTHORIZED);
    }
}
