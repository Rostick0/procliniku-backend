<?php

namespace App\Utils;

class LinkUtil
{
    public static function convertToLink(string $name): string
    {
        return htmlspecialchars(
            strtolower(
                str_replace(' ', '_', $name)
            )
        );
    }
}
