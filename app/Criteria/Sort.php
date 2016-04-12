<?php
namespace App\Criteria;

use Illuminate\Support\Str;

final class Sort extends AbstractCriteriaOption implements CriteriaOption
{
    const NAME = 'sort';

    /**
     * Holds a resolved version of the sorting fields (an associative map with
     * the following format: 'field_name' => 'ASC|DESC').
     *
     * @var array
     */
    private $sortingFields;

    public function __construct($fields)
    {
        parent::__construct($fields);

        $this->sortingFields = $this->resolveSortOrder();
    }

    /**
     * Resolve the - notation to the 'field' => 'order' format.
     *
     * @return array
     */
    private function resolveSortOrder()
    {
        return array_reduce($this->fieldsAsArray(), function ($result, $field) {
            if ($this->isInDescendingOrder($field)) {
                $result[ltrim($field, '-')] = 'DESC';
            } else {
                $result[$field] = 'ASC';
            }

            return $result;
        }) ?: [];
    }

    /**
     * @return mixed
     */
    private function fieldsAsArray()
    {
        return explode(',', $this->value);
    }

    /**
     * @param string $field
     * @return bool
     */
    public function isInDescendingOrder($field)
    {
        return Str::startsWith($field, '-');
    }

    /**
     * @return array
     */
    public function byFields()
    {
        return $this->sortingFields;
    }
}
