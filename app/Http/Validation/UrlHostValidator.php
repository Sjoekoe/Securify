<?php

namespace App\Http\Validation;

use App\Http\ProtocolPrepender;
use App\Validation\Rules\Rule;
use Illuminate\Contracts\Validation\Validator;

class UrlHostValidator implements Rule
{
    const NAME = 'url_host';

    /**
     * @var \App\Http\ProtocolPrepender
     */
    private $protocolPrepender;

    public function __construct(ProtocolPrepender $protocolPrepender)
    {
        $this->protocolPrepender = $protocolPrepender;
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @param array $parameters
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return bool
     */
    public function validate($attribute, $value, array $parameters = [], Validator $validator = null)
    {
        if (! $this->isValidUrlString($value)) {
            return false;
        }

        $value = $this->protocolPrepender->prepend($value);

        return filter_var($value, FILTER_VALIDATE_URL) == true;
    }

    private function isValidUrlString($value)
    {
        return str_contains($value, '.');
    }
}
