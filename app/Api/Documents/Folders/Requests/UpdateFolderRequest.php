<?php
namespace App\Api\Documents\Folders\Requests;

use App\Api\Http\Requests\Request;

class UpdateFolderRequest extends Request
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return $this->getDocumentFromRoute()->id() == $this->getFolderFromRoute()->document()->id();
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }
}
