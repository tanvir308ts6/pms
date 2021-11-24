<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function changeDateFormat(
        string $date,
        string $date_format,
        string $expected_format = 'Y-m-d'
    ): string
    {
        return Carbon::createFromFormat($date_format, $date)->format($expected_format);
    }

    public static function verifyDateFormat(?string $date): ?string
    {
        return isset($date)
            ? self::changeDateFormat($date, 'd/m/Y')
            : null;
    }
}
