<?php
namespace spec\App\ValueObjects;

use App\ValueObjects\ColorContrast;
use App\ValueObjects\HexColor;
use App\ValueObjects\Label;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LabelSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('make', ['Confirmed', new HexColor('#15AE85')]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Label::class);
    }

    function it_can_return_the_label_text()
    {
        $this->text()->shouldReturn('Confirmed');
    }

    function it_can_return_the_background_color()
    {
        $this->backgroundColor()->shouldReturnAnInstanceOf(HexColor::class);
    }

    function it_can_return_the_text_color()
    {
        $this->textColor()->shouldReturnAnInstanceOf(HexColor::class);
    }

    function it_can_return_the_contrast()
    {
        $this->contrast()->shouldReturnAnInstanceOf(ColorContrast::class);
    }

    function it_gives_the_text_color_when_the_contrast_is_higher_than_the_threshold()
    {
        $this->textColor()->withHashtag()->shouldReturn('#fff');
    }

    function it_gives_the_inverse_text_color_when_the_contrast_is_lower_than_the_threshold()
    {
        $this->beConstructedThrough('make', ['Option', new HexColor('#fafafa')]);
        $this->textColor()->withHashtag()->shouldReturn('#333');
    }

    function it_implements_toString()
    {
        $this->__toString()->shouldReturn('Confirmed');
    }
}
