<?php

namespace App\Support;

class Sanitizer
{
    /**
     * Strip HTML tags and surrounding whitespace from a plain-text field.
     */
    public static function clean(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        return trim(strip_tags($value));
    }
}
