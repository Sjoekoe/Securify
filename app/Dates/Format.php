<?php
namespace App\Dates;

use App\Dates\Exceptions\UnknownDateFormatException;

abstract class Format
{
    /**
     * @var array
     */
    protected $labels;

    /**
     * @var array
     */
    protected $examples;

    /**
     * @var array
     */
    protected $javascriptCodes;

    /**
     * @param string $format
     * @return string
     */
    public function label($format)
    {
        $this->assertFormatExists($format);

        return $this->labels[$format];
    }

    /**
     * @param string $format
     * @return string
     */
    public function example($format)
    {
        $this->assertFormatExists($format);

        return $this->examples[$format];
    }

    /**
     * @param string $library
     * @param string $format
     * @return string
     */
    public function javascriptCode($library, $format)
    {
        $this->assertFormatExists($format);

        return $this->javascriptCodes[$library][$format];
    }

    /**
     * @param string $format
     * @throws \App\Dates\Exceptions\UnknownDateFormatException
     */
    protected function assertFormatExists($format)
    {
        $formats = $this->formats();

        if (! in_array($format, $formats)) {
            throw new UnknownDateFormatException;
        }
    }

    /**
     * @return array
     */
    public function labels()
    {
        return $this->labels;
    }

    /**
     * @return array
     */
    public function examples()
    {
        return $this->examples;
    }

    /**
     * @return array
     */
    public function javascriptCodes()
    {
        return $this->javascriptCodes;
    }

    /**
     * @return array
     */
    abstract public function formats();
}
