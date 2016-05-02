<?php
namespace App\Api\Documents\Folders\Requests;

use App\Api\Http\Requests\Request;

class ShowFolderRequest extends Request
{
    public function authorize()
    {
        return $this->getDocumentFromRoute()->id() == $this->getFolderFromRoute()->document()->id();
    }
}
