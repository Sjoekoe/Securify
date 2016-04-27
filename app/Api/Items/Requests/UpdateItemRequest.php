<?php
namespace App\Api\Items\Requests;

use App\Api\Http\Requests\Request;

class UpdateItemRequest extends Request
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
