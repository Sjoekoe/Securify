<?php
namespace App\ValueObjects;

final class ColorContrast
{
    const DEFAULT_THRESHOLD = 70;

    /**
     * @var int|float
     */
    private $contrast;

    /**
     * @var int
     */
    private $threshold;

    public function __construct($contrast, $threshold = self::DEFAULT_THRESHOLD)
    {
        $this->contrast = $contrast;
        $this->threshold = $threshold;
    }

    /**
     * @param \App\ValueObjects\HexColor $mainColor
     * @param \App\ValueObjects\HexColor $secondaryColor
     * @param int $threshold
     * @return \App\ValueObjects\ColorContrast
     */
    public static function between(HexColor $mainColor, HexColor $secondaryColor, $threshold = self::DEFAULT_THRESHOLD)
    {
        return new self(abs($mainColor->toYIQ() - $secondaryColor->toYIQ()), $threshold);
    }

    /**
     * @return bool
     */
    public function isLowerThanThreshold()
    {
        return $this->contrast < $this->threshold;
    }
}
