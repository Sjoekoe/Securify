<?php
namespace App\Api\Visitors;

use App\Api\Accounts\AccountTransformer;
use App\Api\Companies\CompanyTransformer;
use App\Visitors\Visitor;
use League\Fractal\TransformerAbstract;

class VisitorTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'accountRelation',
        'companyRelation',
    ];

    /**
     * @param \App\Visitors\Visitor $visitor
     * @return array
     */
    public function transform(Visitor $visitor)
    {
        return [
            'id' => $visitor->id(),
            'name' => $visitor->name(),
        ];
    }

    /**
     * @param \App\Visitors\Visitor $visitor
     * @return \League\Fractal\Resource\Item
     */
    public function includeAccountRelation(Visitor $visitor)
    {
        return $this->item($visitor->account(), new AccountTransformer());
    }

    /**
     * @param \App\Visitors\Visitor $visitor
     * @return \League\Fractal\Resource\Item
     */
    public function includeCompanyRelation(Visitor $visitor)
    {
        return $this->item($visitor->company(), new CompanyTransformer());
    }
}
