<?php
namespace App\Api\Keys\Requests;

use App\Api\Http\Requests\Request;

class StoreKeyRequest extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'number' => 'int|required',
        ];
    }
}
