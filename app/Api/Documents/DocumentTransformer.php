<?php
namespace App\Api\Documents;

use App\Api\Accounts\AccountTransformer;
use App\Documents\Document;
use League\Fractal\TransformerAbstract;

class DocumentTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'accountRelation',
    ];

    /**
     * @param \App\Documents\Document $document
     * @return array
     */
    public function transform(Document $document)
    {
        return [
            'id' => $document->id(),
            'name' => $document->name(),
        ];
    }

    /**
     * @param \App\Documents\Document $document
     * @return \League\Fractal\Resource\Item
     */
    public function includeAccountRelation(Document $document)
    {
        return $this->item($document->account(), new AccountTransformer());
    }
}
