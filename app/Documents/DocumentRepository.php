<?php
namespace App\Documents;

use App\Accounts\Account;

interface DocumentRepository
{
    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Documents\Document
     */
    public function create(Account $account, array $values);

    /**
     * @param \App\Documents\Document $document
     * @param array $values
     * @return \App\Documents\Document
     */
    public function update(Document $document, array $values);
    
    /**
     * @param \App\Documents\Document $document
     */
    public function delete(Document $document);
    
    /**
     * @param int $id
     * @return \App\Documents\Document|null
     */
    public function find($id);
    
    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \App\Documents\Document
     */
    public function findByAccountPaginated(Account $account, $limit = 10);
}
