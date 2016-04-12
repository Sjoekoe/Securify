<?php
namespace App\Criteria\Exceptions;

class InvalidCriteriaOptionException extends \Exception
{
    /**
     * @param string $name
     * @return \App\Criteria\Exceptions\InvalidCriteriaOptionException
     */
    public static function notAValidName($name)
    {
        return new self("The name [$name] is not a valid criteria option type.");
    }
}
