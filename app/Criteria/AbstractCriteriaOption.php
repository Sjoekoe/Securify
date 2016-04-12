<?php
namespace App\Criteria;

abstract class AbstractCriteriaOption
{
    /**
     * @var string
     */
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param string $value
     * @return static
     */
    public static function make($value)
    {
        return new static($value);
    }

    /**
     * @return string
     */
    public function name()
    {
        return static::NAME;
    }

    /**
     * @return string
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function queryString()
    {
        return static::NAME . '=' . $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }
}
