<?php
namespace App\Criteria;

class CriteriaMapper
{
    private static $options = [
        Includes::NAME => Includes::class,
        Limit::NAME => Limit::class,
        Sort::NAME => Sort::class,
    ];

    /**
     * @param array $values
     * @return \App\Criteria\CriteriaOption[]
     */
    public static function mapValuesToOptions(array $values)
    {
        $options = [];

        foreach ($values as $name => $value) {
            if ($value !== null) {
                $options[$name] = self::mapValueToOption($name, $value);
            }
        }

        return $options;
    }

    public static function mapValueToOption($name, $value)
    {
        if (! array_key_exists($name, self::$options)) {
            throw InvalidCriteriaOptionException::notAValidName($name);
        }

        return new self::$options[$name]($value);
    }
}
