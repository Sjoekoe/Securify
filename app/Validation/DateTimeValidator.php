<?php
namespace App\Validation;

use DateTime;

class DateTimeValidator
{
    public function validateFormat($date, $format = 'Y-m-d')
    {
        if (DateTime::createFromFormat($format, $date) == false) {
            return false;
        }

        return DateTime::getLastErrors()['warning_count'] === 0;
    }
}
