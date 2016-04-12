<?php
namespace spec\App\Criteria;

use App\Criteria\Exceptions\InvalidLimitException;
use App\Criteria\Limit;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LimitSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(6);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Limit::class);
    }

    function it_does_not_accept_an_invalid_keyword_as_a_limit()
    {
        $this->shouldThrow(InvalidLimitException::class)->during('__construct', ['rubbish']);
    }

    function it_accepts_the_all_keyword_as_a_limit()
    {
        $this->beConstructedWith('all');

        $this->value()->shouldReturn('all');
    }

    function it_accepts_a_numeric_limit()
    {
        $this->value()->shouldReturn(6);
    }

    function it_can_return_the_query_string()
    {
        $this->queryString()->shouldReturn('limit=6');
    }

    function it_never_allows_unlimited_results_with_a_numeric_limit()
    {
        $this->allowsUnlimitedResults()->shouldReturn(false);
    }

    function it_allows_unlimited_results_with_the_all_keyword()
    {
        $this->beConstructedWith('all');

        $this->allowsUnlimitedResults()->shouldReturn(true);
    }
}
