<?php

namespace App\Constants;

class IsPublish
{
    const YES = true;
    const NO = false;

    public static function getName(bool $isPublish)
    {
        return static::YES === $isPublish ? 'published' : 'unpublish';
    }

    public static function getOptions()
    {
        return [
            static::YES => 'published',
            static::NO => 'unpublish'
        ];
    }
}