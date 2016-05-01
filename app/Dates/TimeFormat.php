<?php
namespace App\Dates;

class TimeFormat extends Format
{
    const TWENTY_FOUR = 'H:i';
    const TWELVE = 'h:i A';

    const TIMEPICKER = 'timepicker';
    const PICKATIME = 'pickatime';
    const MOMENTJS = 'momentjs';

    /**
     * TimeFormat constructor.
     */
    public function __construct()
    {
        $this->labels = [
            self::TWENTY_FOUR => '24-hour format',
            self::TWELVE => '12-hour format',
        ];

        $this->examples = [
            self::TWENTY_FOUR => 'HH:MM',
            self::TWELVE => 'HH:MM PM',
        ];

        $this->javascriptCodes = [
            self::TIMEPICKER => [
                self::TWENTY_FOUR => 24,
                self::TWELVE => 12,
            ],
            self::PICKATIME => [
                self::TWENTY_FOUR => 'HH:i',
                self::TWELVE => 'hh:i A',
            ],
            self::MOMENTJS => [
                self::TWENTY_FOUR => 'HH:mm',
                self::TWELVE => 'hh:mm A',
            ],
        ];
    }

    /**
     * @return array
     */
    public function formats()
    {
        return [self::TWENTY_FOUR, self::TWELVE];
    }

    /**
     * @param string $format
     * @return bool
     */
    public function isTwentyFourFormat($format)
    {
        return $format === self::TWENTY_FOUR;
    }
}
