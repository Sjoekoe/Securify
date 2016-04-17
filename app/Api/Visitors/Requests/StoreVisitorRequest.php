<?php
namespace App\Api\Visitors\Requests;

use App\Api\Http\Requests\Request;

class StoreVisitorRequest extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'company_id' => 'int|required',
            'name' => 'required',
        ];
    }
}
