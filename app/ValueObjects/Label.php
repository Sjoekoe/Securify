<?php

namespace App\ValueObjects;

class Label
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var \App\ValueObjects\HexColor
     */
    private $backgroundColor;

    /**
     * @var \App\ValueObjects\HexColor
     */
    protected $textColor;

    private function __construct($text, HexColor $backgroundColor)
    {
        $this->text = $text;
        $this->backgroundColor = $backgroundColor;
        $this->textColor = new HexColor('#fff', '#333');
    }

    /**
     * @param string $text
     * @param \App\ValueObjects\HexColor $backgroundColor
     * @return \App\ValueObjects\Label
     */
    public static function make($text, HexColor $backgroundColor)
    {
        return new self($text, $backgroundColor);
    }

    /**
     * @return string
     */
    public function text()
    {
        return $this->text;
    }

    /**
     * @return \App\ValueObjects\HexColor
     */
    public function backgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * @return \App\ValueObjects\HexColor|null
     */
    public function textColor()
    {
        $contrast = $this->contrast();

        return $contrast->isLowerThanThreshold() ? $this->textColor->inverse() : $this->textColor;
    }

    /**
     * @return \App\ValueObjects\ColorContrast
     */
    public function contrast()
    {
        return ColorContrast::between($this->backgroundColor, $this->textColor);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->text();
    }
}
