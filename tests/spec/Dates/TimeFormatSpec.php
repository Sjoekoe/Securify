<?php
namespace spec\App\Dates;

use App\Dates\Exceptions\UnknownDateFormatException;
use App\Dates\TimeFormat;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TimeFormatSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TimeFormat::class);
    }

    function it_should_return_labels()
    {
        $this->labels()->shouldReturn([
            TimeFormat::TWENTY_FOUR => '24-hour format',
            TimeFormat::TWELVE => '12-hour format',
        ]);
    }

    function it_should_return_examples()
    {
        $this->examples()->shouldReturn([
            TimeFormat::TWENTY_FOUR => 'HH:MM',
            TimeFormat::TWELVE => 'HH:MM PM',
        ]);
    }

    function it_should_return_javascript_codes()
    {
        $this->javascriptCodes()->shouldReturn([
            TimeFormat::TIMEPICKER => [
                TimeFormat::TWENTY_FOUR => 24,
                TimeFormat::TWELVE => 12,
            ],
            TimeFormat::PICKATIME => [
                TimeFormat::TWENTY_FOUR => 'HH:i',
                TimeFormat::TWELVE => 'hh:i A',
            ],
            TimeFormat::MOMENTJS => [
                TimeFormat::TWENTY_FOUR => 'HH:mm',
                TimeFormat::TWELVE => 'hh:mm A',
            ],
        ]);
    }

    function it_should_return_the_formats()
    {
        $formats = ['H:i', 'h:i A'];

        $this->formats()->shouldReturn($formats);
    }

    function it_returns_the_javascript_booleans()
    {
        $this->isTwentyFourFormat(TimeFormat::TWENTY_FOUR)->shouldReturn(true);
        $this->isTwentyFourFormat(TimeFormat::TWELVE)->shouldReturn(false);
    }

    function it_should_throw_an_exception_on_a_invalid_format()
    {
        $this->shouldThrow(UnknownDateFormatException::class)->duringExample('foo');
    }
}
