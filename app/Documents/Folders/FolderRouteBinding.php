<?php
namespace App\Documents\Folders;

use App\Http\AbstractRouteBinding;
use App\Http\RouteBinding;

class FolderRouteBinding extends AbstractRouteBinding implements RouteBinding
{
    /**
     * @var \App\Documents\Folders\FolderRepository
     */
    private $folders;

    public function __construct(FolderRepository $folders)
    {
        $this->folders = $folders;
    }

    /**
     * @param int $id
     * @return \App\Documents\Folders\Folder|null
     */
    public function find($id)
    {
        return $this->folders->find($id);
    }
}
