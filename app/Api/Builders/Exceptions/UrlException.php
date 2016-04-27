<?php
namespace App\Api\Builders\Exceptions;

use App\Api\Builders\RequestBuilder;

class UrlException extends \Exception
{
    /**
     * @return \App\Api\Builders\Exceptions\UrlException
     */
    public static function queryStringNotAllowed()
    {
        return new self(
            'URL query parameters should not be added directly to the URL. Make sure to use the ' . RequestBuilder::class . ' instead.'
        );
    }
}
