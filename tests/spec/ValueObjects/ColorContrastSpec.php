<?php
namespace spec\App\ValueObjects;

use App\ValueObjects\ColorContrast;
use App\ValueObjects\HexColor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ColorContrastSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('between', [new HexColor('15AE85'), new HexColor('fff')]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ColorContrast::class);
    }

    function it_can_check_if_the_contrast_between_two_hex_colors_is_lower_than_a_given_threshold()
    {
        $this->isLowerThanThreshold()->shouldReturn(false);
    }
}
