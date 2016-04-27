<?php
namespace App\Criteria;

use App\Api\Builders\QueryParam;

interface CriteriaOption extends QueryParam
{
    /**
     * @return string
     */
    public function name();

    /**
     * @return string
     */
    public function value();
}
