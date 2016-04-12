<?php
namespace spec\App\Criteria;

use App\Criteria\Includes;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IncludesSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('days.stages,venue');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Includes::class);
    }

    function it_can_return_the_query_string()
    {
        $this->queryString()->shouldReturn('include=days.stages,venue');
    }
}
