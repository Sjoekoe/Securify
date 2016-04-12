<?php
namespace App\Criteria;

use App\Criteria\Exceptions\InvalidLimitException;

final class Limit extends AbstractCriteriaOption implements CriteriaOption
{
    const NAME = 'limit';

    const VALUE_DEFAULT = 10;
    const VALUE_ALL = 'all';

    /**
     * A list of all available limit keywords.
     *
     * @var array
     */
    private $limitKeywords = [self::VALUE_ALL];

    public function __construct($limit = self::VALUE_DEFAULT)
    {
        $this->assertValidLimit($limit);

        $this->value = is_numeric($limit) ? (int) $limit : $limit;
    }

    /**
     * @param string|int limit
     * @throws \App\Criteria\Exceptions\InvalidLimitException
     */
    private function assertValidLimit($limit)
    {
        if (! is_numeric($limit) && ! in_array($limit, $this->limitKeywords)) {
            throw InvalidLimitException::unavailableKeyword($limit, $this->limitKeywords);
        }

        if (is_numeric($limit) && $limit == 0) {
            throw InvalidLimitException::cannotBeZero();
        }
    }

    /**
     * @return bool
     */
    public function allowsUnlimitedResults()
    {
        return $this->value === self::VALUE_ALL;
    }
}
