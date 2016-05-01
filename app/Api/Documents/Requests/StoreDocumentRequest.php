<?php
namespace App\Api\Documents\Requests;

use App\Api\Http\Requests\Request;

class StoreDocumentRequest extends Request
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
