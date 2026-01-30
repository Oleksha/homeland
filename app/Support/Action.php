<?php

namespace App\Support;

abstract class Action
{
    public static function run(...$arguments)
    {
        return app(static::class)(...$arguments);
    }
}
