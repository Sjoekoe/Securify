<?php
namespace App\Api\Locations\Doors\Requests;

use App\Api\Http\Requests\Request;

class StoreDoorRequest extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'building_id' => 'required',
            'key_id' => 'required',
        ];
    }
}
