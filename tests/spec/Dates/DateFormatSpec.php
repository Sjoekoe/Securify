<?php
namespace spec\App\Dates;

use App\Dates\DateFormat;
use App\Dates\Exceptions\UnknownDateFormatException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DateFormatSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DateFormat::class);
    }

    function it_should_return_labels()
    {
        $this->labels()->shouldReturn([
            DateFormat::AMERICAN => 'e.g. 01/19/2018',
            DateFormat::EUROPEAN => 'e.g. 19/01/2018',
            DateFormat::ALTERNATIVE => 'e.g. 2018-01-19',
        ]);
    }

    function it_should_return_examples()
    {
        $this->examples()->shouldReturn([
            DateFormat::AMERICAN => '01/19/2018',
            DateFormat::EUROPEAN => '19/01/2018',
            DateFormat::ALTERNATIVE => '2018-01-19',
        ]);
    }

    function it_should_return_javascript_codes()
    {
        $this->javascriptCodes()->shouldReturn([
            DateFormat::DATEPICKER => [
                DateFormat::AMERICAN => 'mm/dd/yyyy',
                DateFormat::EUROPEAN => 'dd/mm/yyyy',
                DateFormat::ALTERNATIVE => 'yyyy-mm-dd',
            ],
            DateFormat::PICKADATE => [
                DateFormat::AMERICAN => 'mm/dd/yyyy',
                DateFormat::EUROPEAN => 'dd/mm/yyyy',
                DateFormat::ALTERNATIVE => 'yyyy-mm-dd',
            ],
            DateFormat::MOMENTJS => [
                DateFormat::AMERICAN => 'MM/DD/YYYY',
                DateFormat::EUROPEAN => 'DD/MM/YYYY',
                DateFormat::ALTERNATIVE => 'YYYY-MM-DD',
            ],
        ]);
    }

    function it_should_return_the_formats()
    {
        $formats = ['m/d/Y', 'd/m/Y', 'Y-m-d'];

        $this->formats()->shouldReturn($formats);
    }

    function it_should_throw_an_exception_on_a_invalid_format()
    {
        $this->shouldThrow(UnknownDateFormatException::class)->duringExample('foo');
    }
}
