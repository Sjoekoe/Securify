<?php
namespace App\ValueObjects;

final class HexColor
{
    /**
     * @var string
     */
    protected $color;

    /**
     * @var string
     */
    protected $inverse;

    public function __construct($color, $inverse = null)
    {
        $this->color = trim($color, '#');
        $this->inverse = trim($inverse, '#');
    }

    /**
     * @return string
     */
    public function withHashtag()
    {
        return "#$this->color";
    }

    /**
     * @return string
     */
    public function withoutHashtag()
    {
        return $this->color;
    }

    /**
     * @return \App\ValueObjects\HexColor|null
     */
    public function inverse()
    {
        return $this->inverse ? new self($this->inverse, $this->color) : null;
    }

    /**
     * @return float
     */
    public function toYIQ()
    {
        $color = $this->toRGB();

        return (($color['r'] * 299) + ($color['g'] * 587) + ($color['b'] * 114)) / 1000;
    }

    /**
     * @return int
     */
    public function toRGB()
    {
        $color = $this->expand();

        return [
            'r' => hexdec(substr($color, 0, 2)),
            'g' => hexdec(substr($color, 2, 2)),
            'b' => hexdec(substr($color, 4, 2)),
        ];
    }

    /**
     * @return string
     */
    private function expand()
    {
        return strlen($this->color) == 3 ? str_repeat($this->color, 2) : $this->color;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->withHashtag();
    }
}
