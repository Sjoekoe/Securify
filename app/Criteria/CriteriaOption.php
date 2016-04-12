<?php
namespace App\Criteria;

interface CriteriaOption
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
