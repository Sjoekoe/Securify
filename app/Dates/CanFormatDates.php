<?php
namespace App\Dates;

use DateTime;

trait CanFormatDates
{
    /**
     * @var \App\Dates\DateTimeCreator
     */
    protected $dateTimeCreator;

    /**
     * @return string
     */
    protected function getDateTimeFormat()
    {
        return $this->dateTimeCreator->dateTimeFormat();
    }

    /**
     * @return string
     */
    protected function getDateFormat()
    {
        return $this->dateTimeCreator->dateFormat();
    }

    /**
     * @return string
     */
    protected function getTimeFormat()
    {
        return $this->dateTimeCreator->timeFormat();
    }

    /**
     * @param \DateTime $date
     * @return string
     */
    protected function formatDate(DateTime $date)
    {
        return $this->dateTimeCreator->formatDate($date);
    }

    /**
     * @param \DateTime $time
     * @return string
     */
    protected function formatTime(DateTime $time)
    {
        return $this->dateTimeCreator->formatTime($time);
    }

    /**
     * @param string $library
     * @return string
     */
    protected function getDateJavascriptCode($library = DateFormat::MOMENTJS)
    {
        return $this->dateTimeCreator->dateJavascriptCode($library);
    }

    /**
     * @param string $library
     * @return string
     */
    protected function getTimeJavascriptCode($library = TimeFormat::MOMENTJS)
    {
        return $this->dateTimeCreator->timeJavascriptCode($library);
    }
}
