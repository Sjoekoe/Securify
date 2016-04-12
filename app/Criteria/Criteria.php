<?php
namespace App\Criteria;

use App\Criteria\Exceptions\InvalidCriteriaOptionException;

class Criteria
{
    /**
     * Holds all requested options, for example, the ones defined in an URL
     * query string.
     *
     * @var array
     */
    private $options = [];

    /**
     * Criteria constructor.
     *
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->setOptions($options);
    }

    private function setOptions(array $options)
    {
        $this->clear();

        foreach ($this->filterValidOptions($options) as $option) {
            $this->options[$option->name()] = $option;
        }
    }

    public function clear()
    {
        $this->options = [];
    }

    /**
     * @param array $options
     * @return \App\Criteria\CriteriaOption
     */
    private function filterValidOptions(array $options)
    {
        return array_filter($options, function($value) {
            return $value instanceof CriteriaOption && $value->value() !== null;
        });
    }

    /**
     * @param array $options
     * @return \App\Criteria\Criteria
     */
    public static function make($options = [])
    {
        $options = is_array($options) ? $options : [$options];

        return new self($options);
    }

    /**
     * @param array $values
     * @return \App\Criteria\Criteria
     */
    public function makeFromValues(array $values)
    {
        return new self(CriteriaMapper::mapValuesToOptions($values));
    }

    public function set($name, $value = null)
    {
        if (is_null($name) && $value instanceof CriteriaOption) {
            $this->options[$value->name()] = $value;
        } elseif ($name instanceof CriteriaOption) {
            $this->options[$name->name()] = $name;
        } elseif ($name !== null && $value !== null) {
            try {
                $this->options[$name] = CriteriaMapper::mapValueToOption($name, $value);
            } catch (InvalidCriteriaOptionException $e) {
                //
            }
        }

        return $this;
    }

    /**
     * @param \App\Criteria\CriteriaOption|string $name
     * @param mixed $value
     * @return static
     */
    public function setIfUndefined($name, $value = null)
    {
        if (! $this->has($name)) {
            $this->set($name, $value);
        }

        return $this;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has($name)
    {
        return array_key_exists($this->resolveName($name), $this->options);
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->options;
    }

    /**
     * @param string $name
     * @return \App\Criteria\CriteriaOption
     */
    public function get($name)
    {
        return $this->options[$name];
    }

    /**
     * @return \App\Criteria\Limit
     */
    public function limit()
    {
        return $this->has(Limit::NAME) ? $this->get(Limit::NAME) : new Limit();
    }

    /**
     * @return \App\Criteria\Sort
     */
    public function sort()
    {
        return $this->get(Sort::NAME);
    }

    /**
     * @param \App\Criteria\CriteriaOption|string $name
     * @return string
     */
    private function resolveName($name)
    {
        return $name instanceof CriteriaOption ? $name->name() : $name;
    }
}
