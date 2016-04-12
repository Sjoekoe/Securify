<?php
namespace App\Criteria\Exceptions;

class InvalidLimitException extends \Exception
{
    /**
     * @param string $limit
     * @param array $limitKeywords
     * @return \App\Criteria\Exceptions\InvalidLimitException
     */
    public static function unavailableKeyword($limit, array $limitKeywords)
    {
        return new self(
            "[$limit] cannot be used as a keyword for limit. The available keywords are: " . implode(',', $limitKeywords) . '.'
        );
    }

    /**
     * @return \App\Criteria\Exceptions\InvalidLimitException
     */
    public static function cannotBeZero()
    {
        return new self("The limit may never be set to 0.");
    }
}
