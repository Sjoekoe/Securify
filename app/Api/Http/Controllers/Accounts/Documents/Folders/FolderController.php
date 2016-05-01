<?php
namespace App\Api\Http\Controllers\Accounts\Documents\Folders;

use App\Accounts\Account;
use App\Api\Documents\Folders\FolderTransformer;
use App\Api\Documents\Folders\Requests\StoreFolderRequest;
use App\Api\Http\Controller;
use App\Documents\Document;
use App\Documents\Folders\Folder;
use App\Documents\Folders\FolderRepository;

class FolderController extends Controller
{
    /**
     * @var \App\Documents\Folders\FolderRepository
     */
    private $folders;

    public function __construct(FolderRepository $folders)
    {
        $this->folders = $folders;
    }

    public function index(Account $account, Document $document)
    {
        $folders = $this->folders->findByDocumentPaginated($document);

        return $this->response()->paginator($folders, new FolderTransformer());
    }

    public function store(StoreFolderRequest $request, Account $account, Document $document)
    {
        $folder = $this->folders->create($document, $request->all());

        return $this->response()->item($folder, new FolderTransformer());
    }

    public function show(Account $account, Document $document, Folder $folder)
    {
        return $this->response()->item($folder, new FolderTransformer());
    }

    public function update(StorefolderRequest $request, Account $account, Document $document, Folder $folder)
    {
        $folder = $this->folders->update($folder, $request->all());

        return $this->response()->item($folder, new FolderTransformer());
    }

    public function delete(Account $account, Document $document, Folder $folder)
    {
        $this->folders->delete($folder);

        return $this->response()->noContent();
    }
}
