<?php
namespace App\Api\Locations\Buildings\Requests;

use App\Api\Http\Requests\Request;

class StoreBuildingRequest extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }
}
