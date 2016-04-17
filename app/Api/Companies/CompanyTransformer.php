<?php
namespace App\Api\Companies;

use App\Api\Accounts\AccountTransformer;
use App\Companies\Company;
use League\Fractal\TransformerAbstract;

class CompanyTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'accountRelation',
    ];

    /**
     * @param \App\Companies\Company $company
     * @return array
     */
    public function transform(Company $company)
    {
        return [
            'id' => $company->id(),
            'name' => $company->name(),
            'email' => $company->email(),
            'website' => $company->website(),
            'telephone' => $company->telephone(),
            'vat' => $company->vat(),
        ];
    }

    /**
     * @param \App\Companies\Company $company
     * @return \League\Fractal\Resource\Item
     */
    public function includeAccountRelation(Company $company)
    {
        return $this->item($company->account(), new AccountTransformer());
    }
}
