<?php
namespace App\Dates\Validation;

use App\Dates\CanFormatDates;
use App\Dates\DateTimeCreator;
use App\Validation\DateTimeValidator;
use App\Validation\Rules\Rule;
use Illuminate\Contracts\Validation\Validator;

class AccountDateFormatRule implements Rule
{
    use CanFormatDates;

    const NAME = 'account_date_format';

    /**
     * @var \App\Validation\DateTimeValidator
     */
    private $dateTimeValidator;

    public function __construct(DateTimeCreator $dateTimeCreator, DateTimeValidator $dateTimeValidator)
    {
        $this->dateTimeCreator = $dateTimeCreator;
        $this->dateTimeValidator = $dateTimeValidator;
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
        return $this->dateTimeValidator->validateFormat($value, $this->getDateFormat());
    }
}
