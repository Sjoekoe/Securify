<?php
namespace App\Dates;

use App\Accounts\Account;
use DateTime;

class DateTimeCreator
{
    /**
     * @var string
     */
    protected $dateFormat;

    /**
     * @var string
     */
    protected $timeFormat;

    public function __construct($dateFormat = null, $timeFormat = null)
    {
        if (! is_null($dateFormat)) {
            $this->dateFormat = $dateFormat;
        } elseif (auth()->checkTeam() && securify_account()->dateFormat()) {
            $this->dateFormat = securify_account()->dateFormat();
        } else {
            $this->dateFormat = DateFormat::EUROPEAN;
        }

        if (! is_null($timeFormat)) {
            $this->timeFormat = $timeFormat;
        } elseif (auth()->checkTeam() && securify_account()->timeFormat()) {
            $this->timeFormat = securify_account()->timeFormat();
        } else {
            $this->timeFormat = TimeFormat::TWENTY_FOUR;
        }
    }

    /**
     * @param \App\Accounts\Account $account
     * @return \App\Dates\DateTimeCreator
     */
    public static function makeFromAccount(Account $account)
    {
        return new self($account->dateFormat(), $account->timeFormat());
    }

    /**
     * @param \DateTime $date
     * @return string
     */
    public function formatDate(DateTime $date)
    {
        return $date->format($this->dateFormat());
    }

    /**
     * @param \DateTime $time
     * @return string
     */
    public function formatTime(DateTime $time)
    {
        return $time->format($this->timeFormat());
    }

    /**
     * @return string
     */
    public function dateTimeFormat()
    {
        return $this->dateFormat() . ' ' . $this->timeFormat();
    }

    /**
     * @return string
     */
    public function dateExample()
    {
        return (new DateFormat())->example($this->dateFormat());
    }

    /**
     * @return string
     */
    public function timeExample()
    {
        return (new TimeFormat())->example($this->timeFormat());
    }

    /**
     * @param string $library
     * @return string
     */
    public function dateJavascriptCode($library)
    {
        return (new DateFormat())->javascriptCode($library, $this->dateFormat());
    }

    /**
     * @param string $library
     * @return string
     */
    public function timeJavascriptCode($library)
    {
        return (new TimeFormat())->javascriptCode($library, $this->timeFormat());
    }

    /**
     * @return bool
     */
    public function isTwentyFourFormat()
    {
        return (new TimeFormat())->isTwentyFourFormat($this->timeFormat());
    }

    /**
     * @return string
     */
    public function dateFormat()
    {
        return $this->dateFormat;
    }

    /**
     * @return string
     */
    public function timeFormat()
    {
        return $this->timeFormat;
    }

    /**
     * @return array
     */
    public function formats()
    {
        return [
            'date' => [
                'php' => $this->dateFormat,
                DateFormat::MOMENTJS => $this->dateJavascriptCode(DateFormat::MOMENTJS),
                DateFormat::DATEPICKER => $this->dateJavascriptCode(DateFormat::DATEPICKER),
                DateFormat::PICKADATE => $this->dateJavascriptCode(DateFormat::PICKADATE),
            ],
            'time' => [
                'php' => $this->timeFormat,
                TimeFormat::MOMENTJS => $this->timeJavascriptCode(TimeFormat::MOMENTJS),
                TimeFormat::TIMEPICKER => $this->timeJavascriptCode(TimeFormat::TIMEPICKER),
                TimeFormat::PICKATIME => $this->timeJavascriptCode(TimeFormat::PICKATIME),
            ]
        ];
    }
}
