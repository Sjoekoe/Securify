<?php
namespace spec\App\Criteria;

use App\Criteria\Criteria;
use App\Criteria\Includes;
use App\Criteria\Limit;
use App\Criteria\Sort;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CriteriaSpec extends ObjectBehavior
{
    private $values = [
        Includes::NAME => 'foo',
        Limit::NAME => 6,
        Sort::NAME => 'foo',
    ];

    function let()
    {
        $this->beConstructedThrough('make');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Criteria::class);
    }

    function it_can_make_with_a_single_option()
    {
        $this::make(new Includes('foo'))->shouldReturnAnInstanceOf(Criteria::class);
    }

    function it_can_make_with_multiple_single_option()
    {
        $this::make([new Includes('foo'), new Limit(5)])->shouldReturnAnInstanceOf(Criteria::class);
    }

    function it_can_make_from_values()
    {
        $this::makeFromValues($this->values)->shouldReturnAnInstanceOf(Criteria::class);
    }

    function it_filters_out_null_values()
    {
        $this::make(new Includes(null))->has(Includes::NAME)->shouldReturn(false);
    }

    function it_filters_out_null_values_when_setting_through_values()
    {
        $this::makeFromValues([Includes::NAME => null])->has(Includes::NAME)->shouldReturn(false);
    }

    function it_always_sets_the_limit()
    {
        $this->limit()->shouldReturnAnInstanceOf(Limit::class);
    }

    function it_can_set_an_option()
    {
        $this->set(new Includes('foo'))->has(Includes::NAME)->shouldReturn(true);
    }

    function it_can_set_an_option_with_a_key_value()
    {
        $this->set(Includes::NAME, 'foo')->has(Includes::NAME)->shouldReturn(true);
    }

    function it_can_set_options_when_undefined()
    {
        $this->setIfUndefined(Includes::NAME, 'foo')->has(Includes::NAME)->shouldReturn(true);
    }

    function it_does_not_overwrite_options_when_setting_through_setIfUndefined()
    {
        $stub = new Includes('foo');

        $this->set($stub);
        $this->setIfUndefined(new Includes('bar'))->get(Includes::NAME)->shouldReturn($stub);
    }

    function it_can_check_if_an_option_is_set()
    {
        $this::make(new Limit(5))->has(new Limit())->shouldReturn(true);
    }

    function it_does_not_set_a_default_option_when_it_is_being_passed_through_the_constructor()
    {
        $this::make(new Limit(5))->limit()->value()->shouldReturn(5);
    }

    function it_can_return_all_options()
    {
        $this::make(new Includes(5))->all()->shouldHaveCount(1);
    }
}
