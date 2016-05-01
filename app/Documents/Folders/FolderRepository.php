<?php
namespace App\Documents\Folders;

use App\Documents\Document;

interface FolderRepository
{
    /**
     * @param \App\Documents\Document $document
     * @param array $values
     * @return \App\Documents\Folders\Folder
     */
    public function create(Document $document, array $values);
    
    /**
     * @param \App\Documents\Folders\Folder $folder
     * @param array $values
     * @return \App\Documents\Folders\Folder
     */
    public function update(Folder $folder, array $values);
    
    /**
     * @param \App\Documents\Folders\Folder $folder
     */
    public function delete(Folder $folder);
    
    /**
     * @param int $id
     * @return \App\Documents\Folders\Folder|null
     */
    public function find($id);
    
    /**
     * @param \App\Documents\Document $document
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByDocumentPaginated(Document $document, $limit = 10);
}
