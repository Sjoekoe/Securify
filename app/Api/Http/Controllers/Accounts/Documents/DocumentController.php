<?php
namespace App\Api\Http\Controllers\Accounts\Documents;

use App\Accounts\Account;
use App\Api\Documents\DocumentTransformer;
use App\Api\Documents\Requests\ShowDocumentRequest;
use App\Api\Documents\Requests\StoreDocumentRequest;
use App\Api\Documents\Requests\UpdateDocumentRequest;
use App\Api\Http\Controller;
use App\Documents\Document;
use App\Documents\DocumentRepository;

class DocumentController extends Controller
{
    /**
     * @var \App\Documents\DocumentRepository
     */
    private $documents;

    public function __construct(DocumentRepository $documents)
    {
        $this->documents = $documents;
    }

    public function index(Account $account)
    {
        $documents = $this->documents->findByAccountPaginated($account);

        return $this->response()->paginator($documents, new DocumentTransformer());
    }

    public function store(StoreDocumentRequest $request, Account $account)
    {
        $document = $this->documents->create($account, $request->all());

        return $this->response()->item($document, new DocumentTransformer());
    }

    public function show(ShowDocumentRequest $request, Account $account, Document $document)
    {
        return $this->response()->item($document, new DocumentTransformer());
    }

    public function update(UpdateDocumentRequest $request, Account $account, Document $document)
    {
        $document = $this->documents->update($document, $request->all());

        return $this->response()->item($document, new DocumentTransformer());
    }

    public function delete(ShowDocumentRequest $request, Account $account, Document $document)
    {
        $this->documents->delete($document);

        return $this->response()->noContent();
    }
}
