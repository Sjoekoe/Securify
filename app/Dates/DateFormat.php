<?php

namespace App\Dates;

class DateFormat extends Format
{
    const AMERICAN = 'm/d/Y';
    const EUROPEAN = 'd/m/Y';
    const ALTERNATIVE = 'Y-m-d';

    const DATEPICKER = 'datepicker';
    const PICKADATE = 'pickadate';
    const MOMENTJS = 'momentjs';

    public function __construct()
    {
        $this->labels = [
            self::AMERICAN => 'e.g. 01/19/2018',
            self::EUROPEAN => 'e.g. 19/01/2018',
            self::ALTERNATIVE => 'e.g. 2018-01-19',
        ];

        $this->examples = [
            self::AMERICAN => '01/19/2018',
            self::EUROPEAN => '19/01/2018',
            self::ALTERNATIVE => '2018-01-19',
        ];

        $this->javascriptCodes = [
            self::DATEPICKER => [
                self::AMERICAN => 'mm/dd/yyyy',
                self::EUROPEAN => 'dd/mm/yyyy',
                self::ALTERNATIVE => 'yyyy-mm-dd',
            ],
            self::PICKADATE => [
                self::AMERICAN => 'mm/dd/yyyy',
                self::EUROPEAN => 'dd/mm/yyyy',
                self::ALTERNATIVE => 'yyyy-mm-dd',
            ],
            self::MOMENTJS => [
                self::AMERICAN => 'MM/DD/YYYY',
                self::EUROPEAN => 'DD/MM/YYYY',
                self::ALTERNATIVE => 'YYYY-MM-DD',
            ],
        ];
    }

    /**
     * @return array
     */
    public function formats()
    {
        return [
            self::AMERICAN,
            self::EUROPEAN,
            self::ALTERNATIVE,
        ];
    }
}
