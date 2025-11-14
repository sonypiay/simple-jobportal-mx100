<?php

namespace App\Constants;

class IsActive
{
    const ACTIVE = true;
    const INACTIVE = false;

    public static function getName(bool $isActive)
    {
        return static::ACTIVE === $isActive ? 'Active' : 'Inactive';
    }

    public static function getOptions()
    {
        return [
            static::ACTIVE => 'Active',
            static::INACTIVE => 'Inactive'
        ];
    }
}