<?php

namespace App\Service\PlatformService\Enum;

use ReflectionClass;

enum Platform:int
{
    case Vkontakte = 1;
    case Telegram = 2;

    final public static function getValues(): array
    {
        $class = new ReflectionClass(static::class);
        return array_values($class->getConstants());
    }

    final public static function getDescription(): array
    {
        $class = new ReflectionClass(static::class);
        return $class->getConstants();
    }
}