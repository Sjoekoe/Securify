<?php
namespace App\Api\Documents\Folders\Requests;

use App\Api\Http\Requests\Request;

class StoreFolderRequest extends Request
{
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
