<?php

namespace DeGraciaMathieu\LaravelManagerGenerator;

class StringParser
{
    public static function camelCase(string $string) :string
    {
        $string = preg_replace('/[^a-z0-9' . implode('', []) . ']+/i', ' ', $string);
        $string = trim($string);
        $string = ucwords($string);
        $string = str_replace(' ', '', $string);
        $string = lcfirst($string);

        return $string;
    }

    public static function snakeCase(string $string) :string
    {
        return $string;
    }

    public static function pascalCase(string $string) :string
    {
        return $string;
    }  

    public static function concatenateForPath(array $bits) :string
    {
        $bits = self::sanitizeConcatenate($bits);

        return implode('/', $bits);
    }

    public static function concatenateForNamespace(array $bits) :string
    {
        $bits = self::sanitizeConcatenate($bits);

        return implode('\'', $bits);
    }

    protected static function sanitizeConcatenate(array $bits) :array
    {
        return array_filter($bits, function($bit) {
            return ! is_null($bit);
        });
    }
}
