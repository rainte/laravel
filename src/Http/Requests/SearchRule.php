<?php

namespace Rainte\Laravel\Http\Requests;

use Rainte\Laravel\Http\Requests\Request;
use Rainte\Laravel\Rules\Rule;

class SearchRule extends Request
{
    /**
     * @inheritdoc
     */
    public static function defaultRules(): array
    {
        return Rule::page();
    }
}
