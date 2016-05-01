<?php
namespace App\Api\Documents\Folders;

use App\Api\Accounts\AccountTransformer;
use App\Api\Documents\DocumentTransformer;
use App\Documents\Folders\Folder;
use League\Fractal\TransformerAbstract;

class FolderTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'accountRelation',
        'documentRelation',
        'parentFolderRelation',
    ];

    /**
     * @param \App\Documents\Folders\Folder $folder
     * @return array
     */
    public function transform(Folder $folder)
    {
        return [
            'id' => $folder->id(),
            'name' => $folder->name(),
        ];
    }

    /**
     * @param \App\Documents\Folders\Folder $folder
     * @return \League\Fractal\Resource\Item
     */
    public function includeAccountRelation(Folder $folder)
    {
        return $this->item($folder->account(), new AccountTransformer());
    }

    /**
     * @param \App\Documents\Folders\Folder $folder
     * @return \League\Fractal\Resource\Item
     */
    public function includeDocumentRelation(Folder $folder)
    {
        return $this->item($folder->document(), new DocumentTransformer());
    }

    /**
     * @param \App\Documents\Folders\Folder $folder
     * @return \League\Fractal\Resource\Item|null
     */
    public function includeParentFolderRelation(Folder $folder)
    {
        return $folder->parentFolder() ? $this->item($folder->parentFolder(), new FolderTransformer()) : null;
    }
}
