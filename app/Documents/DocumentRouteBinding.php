<?php
namespace App\Documents;

use App\Http\AbstractRouteBinding;
use App\Http\RouteBinding;

class DocumentRouteBinding extends AbstractRouteBinding implements RouteBinding
{
    /**
     * @var \App\Documents\DocumentRepository
     */
    private $documents;

    public function __construct(DocumentRepository $documents)
    {
        $this->documents = $documents;
    }

    /**
     * @param int $id
     * @return \App\Documents\Document|null
     */
    public function find($id)
    {
        return $this->documents->find($id);
    }
}
