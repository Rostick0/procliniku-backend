<?php

namespace App\Utils;

class EnumFields
{
    public static function getColumn($enum): array
    {
        return array_column($enum::cases(), 'value');
    }

    public static function getValidateValues($enum): string
    {
        return implode(',', self::getColumn($enum));
    }
}
