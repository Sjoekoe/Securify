<?php
namespace App\Api\Visitors\Requests;

use App\Api\Http\Requests\Request;

class UpdateVisitorRequest extends Request
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
