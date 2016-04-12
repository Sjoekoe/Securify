<?php
namespace spec\App\Criteria;

use App\Criteria\Sort;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SortSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('name');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Sort::class);
    }

    function it_can_return_the_query_string()
    {
        $this->queryString()->shouldReturn('sort=name');
    }

    function it_can_return_the_sorting_fields()
    {
        $this->byFields()->shouldReturn(['name' => 'ASC']);
    }

    function it_can_request_to_sort_in_a_descending_order_on_a_field_using_the_minus_notation()
    {
        $this->beConstructedWith('-name');

        $this->queryString()->shouldReturn('sort=-name');
        $this->byFields()->shouldReturn(['name' => 'DESC']);
    }

    function it_accepts_multiple_arguments_on_init()
    {
        $this->beConstructedWith('name,-created_at');

        $this->queryString()->shouldReturn('sort=name,-created_at');
        $this->byFields()->shouldReturn([
            'name' => 'ASC',
            'created_at' => 'DESC',
        ]);
    }

    function it_implements_the_to_string_method()
    {
        $this->__toString()->shouldReturn('name');
    }
}
