<?php
namespace App\Documents;

use App\Accounts\Account;

class EloquentDocumentRepository implements DocumentRepository
{
    /**
     * @var \App\Documents\EloquentDocument
     */
    private $document;

    public function __construct(EloquentDocument $document)
    {
        $this->document = $document;
    }

    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Documents\Document
     */
    public function create(Account $account, array $values)
    {
        $document = new EloquentDocument($values);
        $document->account_id = $account->id();

        $document->save();

        return $document;
    }

    /**
     * @param \App\Documents\Document $document
     * @param array $values
     * @return \App\Documents\Document
     */
    public function update(Document $document, array $values)
    {
        if (array_key_exists('name', $values)) {
            $document->name = $values['name'];
        }

        $document->save();

        return $document;
    }

    /**
     * @param \App\Documents\Document $document
     */
    public function delete(Document $document)
    {
        $document->delete();
    }

    /**
     * @param int $id
     * @return \App\Documents\Document|null
     */
    public function find($id)
    {
        return $this->document->where('id', $id)->first();
    }

    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \App\Documents\Document
     */
    public function findByAccountPaginated(Account $account, $limit = 10)
    {
        return $this->document
            ->where('account_id', $account->id())
            ->paginate($limit);
    }
}
