<?php
namespace spec\App\ValueObjects;

use App\ValueObjects\HexColor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HexColorSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('#15AE85');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(HexColor::class);
    }

    function it_gives_the_hex_color_with_the_hashtag_when_we_ask_for_it()
    {
        $this->beConstructedWith('#15AE85');
        $this->withHashtag()->shouldReturn('#15AE85');
    }

    function it_gives_the_hex_color_with_the_hashtag_when_we_ask_for_it_even_when_the_given_color_does_not_have_one()
    {
        $this->beConstructedWith('15AE85');
        $this->withHashtag()->shouldReturn('#15AE85');
    }

    function it_gives_the_hex_color_without_the_hashtag_when_we_ask_not_to_prepend_it()
    {
        $this->beConstructedWith('15AE85');
        $this->withoutHashtag()->shouldReturn('15AE85');
    }

    function it_gives_the_hex_color_without_the_hashtag_when_we_ask_not_to_prepend_it_even_when_the_given_color_has_one()
    {
        $this->beConstructedWith('#15AE85');
        $this->withoutHashtag()->shouldReturn('15AE85');
    }

    function it_accepts_lowercases()
    {
        $this->beConstructedWith('#22e6ba');
        $this->withHashtag()->shouldReturn('#22e6ba');
    }

    function it_accepts_the_short_hex_notation()
    {
        $this->beConstructedWith('#666');
        $this->withHashtag()->shouldReturn('#666');
    }

    function it_can_return_the_inverse_color_if_it_is_set()
    {
        $this->beConstructedWith('#fff', '#333');
        $this->inverse()->shouldReturnAnInstanceOf(HexColor::class);
    }

    function it_can_be_converted_to_rgb()
    {
        $this->toRGB()->shouldReturn(['r' => 21, 'g' => 174, 'b' => 133]);
    }

    function it_can_be_converted_to_yiq()
    {
        $this->toYIQ()->shouldReturn(123.579);
    }

    function it_implements_toString()
    {
        $this->__toString()->shouldReturn('#15AE85');
    }
}
