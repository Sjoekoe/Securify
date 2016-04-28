<?php
namespace App\Api\Items\Groups\Requests;

use App\Api\Http\Requests\Request;

class StoreItemGroupRequest extends Request
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
