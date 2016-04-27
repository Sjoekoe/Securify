<?php
namespace spec\App\Api\Builders;

use App\Api\Api;
use App\Api\Builders\RequestBuilder;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RequestBuilderSpec extends ObjectBehavior
{
    function let(Api $api)
    {
        $this->beConstructedWith($api, '/accounts/639');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(RequestBuilder::class);
    }

    function it_can_add_a_limit_to_the_query_string_using_a_valid_keyword()
    {
        $this->limit('all')->buildUrl()->shouldReturn('/accounts/639?limit=all');
    }

    function it_can_add_the_all_limit_and_get_the_api_response_with_the_all_helper()
    {
        $this->all()->shouldReturn(null);

        $this->buildUrl()->shouldReturn('/accounts/639?limit=all');
    }

    function it_can_add_a_numeric_limit_to_the_query_string()
    {
        $this->limit(6)->buildUrl()->shouldReturn('/accounts/639?limit=6');
    }

    function it_can_add_includes_to_the_query_string()
    {
        $this->includes('days.stages,bookings')->buildUrl()->shouldReturn('/accounts/639?include=days.stages,bookings');
    }

    function it_can_add_a_sort_parameter_to_the_query_string()
    {
        $this->sort('name')->buildUrl()->shouldReturn('/accounts/639?sort=name');
    }

    function it_can_add_a_descending_sort_parameter_to_the_query_string()
    {
        $this->sort('-name')->buildUrl()->shouldReturn('/accounts/639?sort=-name');
    }

    function it_can_add_multiple_sort_parameters_to_the_query_string()
    {
        $this->sort('name,-symbol,created_at')->buildUrl()->shouldReturn('/accounts/639?sort=name,-symbol,created_at');
    }

    function it_can_build_an_url_including_all_query_string_components()
    {
        $this->limit(60)
            ->includes('venue,bookings.artist')
            ->sort('name,-created_at')
            ->buildUrl()
            ->shouldReturn('/accounts/639?limit=60&include=venue,bookings.artist&sort=name,-created_at');
    }

    function it_can_build_an_url_including_all_query_string_components_with_the_all_helper()
    {
        $this->includes('venue,bookings.artist')->sort('name,-created_at')->all();

        $this->buildUrl()->shouldReturn('/accounts/639?include=venue,bookings.artist&sort=name,-created_at&limit=all');
    }
}
