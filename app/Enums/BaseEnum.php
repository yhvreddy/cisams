<?php

namespace App\Enums;

use ReflectionClass;

abstract class BaseEnum
{
    /**
     * Get the keys of the enum.
     *
     * @return array
     */
    public static function keys()
    {
        return array_keys(static::toArray());
    }

    /**
     * Get the values of the enum.
     *
     * @return array
     */
    public static function values()
    {
        return array_values(static::toArray());
    }

    /**
     * Get the enum as an array.
     *
     * @return array
     */
    public static function toArray()
    {
        $class = new ReflectionClass(static::class);
        return $class->getConstants();
    }

    /**
     * Get the enum key by value.
     *
     * @param mixed $value
     * @return string|null
     */
    public static function getKey($value)
    {
        return array_search($value, static::toArray(), true);
    }

    /**
     * Get the enum value by key.
     *
     * @param string $key
     * @return mixed|null
     */
    public static function getValue($key)
    {
        return static::toArray()[$key] ?? null;
    }
}
