<?php
namespace App\Validation\Exceptions;

use Illuminate\Support\MessageBag;

class FailedRequestValidation extends \Exception
{
    /**
     * @var \Illuminate\Support\MessageBag
     */
    private $errors;

    public function __construct($message, MessageBag $errors)
    {
        $this->errors = $errors;

        parent::__construct($message);
    }

    /**
     * @return \Illuminate\Support\MessageBag
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
