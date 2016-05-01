<?php
namespace App\Documents\Folders;

use App\Documents\EloquentDocument;
use App\Helpers\BelongsToAccount;
use App\Helpers\StandardModel;
use Illuminate\Database\Eloquent\Model;

class EloquentFolder extends Model implements Folder
{
    use StandardModel, BelongsToAccount;

    /**
     * @var string
     */
    protected $table = self::TABLE;

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function documentRelation()
    {
        return $this->belongsTo(EloquentDocument::class, 'document_id', 'id');
    }

    /**
     * @return \App\Documents\Document
     */
    public function document()
    {
        return $this->documentRelation()->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentFolderRelation()
    {
        return $this->belongsTo(EloquentFolder::class, 'parent_folder_id', 'id');
    }

    /**
     * @return \App\Documents\Folders\Folder|null
     */
    public function parentFolder()
    {
        return $this->parentFolderRelation()->first();
    }
}
