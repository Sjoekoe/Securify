<?php
namespace App\Documents\Folders;

use App\Documents\Document;

class EloquentFolderRepository implements FolderRepository
{
    /**
     * @var \App\Documents\Folders\EloquentFolder
     */
    private $folder;

    public function __construct(EloquentFolder $folder)
    {
        $this->folder = $folder;
    }

    /**
     * @param \App\Documents\Document $document
     * @param array $values
     * @return \App\Documents\Folders\Folder
     */
    public function create(Document $document, array $values)
    {
        $folder = new EloquentFolder($values);
        $folder->account_id = $document->account()->id();
        $folder->document_id = $document->id();

        $folder->save();

        return $folder;
    }

    /**
     * @param \App\Documents\Folders\Folder $folder
     * @param array $values
     * @return \App\Documents\Folders\Folder
     */
    public function update(Folder $folder, array $values)
    {
        if (array_key_exists('name', $values)) {
            $folder->name = $values['name'];
        }

        $folder->save();

        return $folder;
    }

    /**
     * @param \App\Documents\Folders\Folder $folder
     */
    public function delete(Folder $folder)
    {
        $folder->delete();
    }

    /**
     * @param int $id
     * @return \App\Documents\Folders\Folder|null
     */
    public function find($id)
    {
        return $this->folder->where('id', $id)->first();
    }

    /**
     * @param \App\Documents\Document $document
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByDocumentPaginated(Document $document, $limit = 10)
    {
        return $this->folder
            ->where('document_id', $document->id())
            ->paginate($limit);
    }
}
