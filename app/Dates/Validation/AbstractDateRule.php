<?php
namespace App\Dates\Validation;

use App\Dates\CanFormatDates;
use App\Dates\DateTimeCreator;
use App\Validation\DateTimeValidator;
use App\Validation\Exceptions\FailedRequestValidation;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\MessageBag;

abstract class AbstractDateRule
{
    use CanFormatDates;

    /**
     * @var \App\Validation\DateTimeValidator
     */
    private $dateTimeValidator;

    public function __construct(DateTimeCreator $dateTimeCreator, DateTimeValidator $dateTimeValidator)
    {
        $this->dateTimeCreator = $dateTimeCreator;
        $this->dateTimeValidator = $dateTimeValidator;
    }

    public function validate($attribute, $value, array $parameters = [], Validator $validator = null)
    {
        $startDate = $parameters[0];
        $startTime = array_get($parameters, 1);
        $endDate = $value;
        $endTime = array_get($parameters, 2);

        $this->checkDateFormat($startDate, $attribute, 'start date');
        $this->checkDateFormat($endDate, $attribute, 'end date');

        if ($startTime) {
            $this->checkTimeFormat($startTime, $attribute, 'start time');
        }

        if ($endTime) {
            $this->checkTimeFormat($endTime, $attribute, 'end time');
        }

        $start = $this->convertToDateTime($startDate, $startTime);
        $end = $this->convertToDateTime($endDate, $endTime);

        return [$start, $end];
    }

    /**
     * @param string $date
     * @param string $attribute
     * @param string $field
     * @throws \App\Validation\Exceptions\FailedRequestValidation
     */
    private function checkDateFormat($date, $attribute, $field)
    {
        if (! $this->dateTimeValidator->validateFormat($date, $this->getDateFormat())) {
            $message = 'The ' . $field . ' is required.';

            throw new FailedRequestValidation($message, new MessageBag([
                $attribute => $message
            ]));
        }
    }

    /**
     * @param string $time
     * @param string $attribute
     * @param string $field
     * @throws \App\Validation\Exceptions\FailedRequestValidation
     */
    private function checkTimeFormat($time, $attribute, $field)
    {
        if (! $this->dateTimeValidator->validateFormat($time, $this->getTimeFormat())) {
            $message = 'The ' . $field . ' is required.';

            throw new FailedRequestValidation($message, new MessageBag([
                $attribute => $message
            ]));
        }
    }

    /**
     * @param string $date
     * @param string $time
     * @return \Carbon\Carbon
     */
    private function convertToDateTime($date, $time = null)
    {
        if ($time) {
            return Carbon::createFromFormat($this->getDateTimeFormat(), $date . ' ' . $time);
        }

        return Carbon::createFromFormat($this->getDateFormat(), $date);
    }
}
