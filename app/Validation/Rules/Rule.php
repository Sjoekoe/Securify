<?php
namespace App\Validation\Rules;

use Illuminate\Contracts\Validation\Validator;

interface Rule
{
    /**
     * @param string $attribute
     * @param mixed $value
     * @param array $parameters
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return bool
     */
    public function validate($attribute, $value, array $parameters = [], Validator $validator = null);
}
