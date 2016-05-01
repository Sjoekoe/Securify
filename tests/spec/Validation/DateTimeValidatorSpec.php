<?php
namespace spec\App\Validation;

use App\Validation\DateTimeValidator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DateTimeValidatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DateTimeValidator::class);
    }

    function it_should_return_true_on_a_valid_date_format()
    {
        $this->validateFormat('2014-05-26')->shouldReturn(true);
    }

    function it_should_return_false_on_an_invalid_date_format()
    {
        $this->validateFormat('2014-05-26', 'd/m/y')->shouldReturn(false);
        $this->validateFormat('2015-30-01', 'Y-n-j')->shouldReturn(false);
    }
}
