<?php

namespace Rainte\Laravel\Services;

abstract class Service
{
    public static function fake()
    {
        return new static();
    }
}
