<?php
namespace App\Companies;

use App\Http\AbstractRouteBinding;
use App\Http\RouteBinding;

class CompanyRouteBinding extends AbstractRouteBinding implements RouteBinding
{
    /**
     * @var \App\Companies\CompanyRepository
     */
    private $companies;

    public function __construct(CompanyRepository $companies)
    {
        $this->companies = $companies;
    }

    /**
     * @param int|string $id
     * @return \App\Companies\Company|null
     */
    public function find($id)
    {
        return $this->companies->find($id);
    }
}
