<?php
namespace App\Dates\Validation;

use App\Validation\Rules\Rule;
use Illuminate\Contracts\Validation\Validator;

class BeforeDateRule extends AbstractDateRule implements Rule
{
    const NAME = 'before_date';

    /**
     * @param string $attribute
     * @param mixed $value
     * @param array $parameters
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return bool
     */
    public function validate($attribute, $value, array $parameters = [], Validator $validator = null)
    {
        list($start, $end) = parent::validate($attribute, $value, $parameters, $validator);

        return $start >= $end;
    }
}
